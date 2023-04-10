<?php

namespace App\Service;

use Exception;

class Router
{
    /**
     * regex pour calculer un paramètre de route
     * 
     * @var string
     */
    private const PARAM_REGEX = '/:([a-zA-Z][a-zA-Z1-9]*)/';

    /**
     * le chemin courant
     *
     * @var string
     */
    public $currentPath;

    /**
     * la méthode http courante
     *
     * @var string
     */
    public $currentMethod;

    /**
     * routes déclarées
     *
     * @var array<string, array<string>>
     */
    private static $routes = [
        "main_index" => [ // nom de la route
            "", // route
            "GET", // méthode
            "MainController", // contrôleur
            "index" // méthode du contrôleur
        ],
        "user_register" => [
            "register",
            "GET|POST",
            "User\RegisterController",
            "register"
        ],
        "user_login" => [
            "login",
            "GET|POST",
            "User\LoginController",
            "login"
        ],
        "user_logout" => [
            "logout",
            "GET",
            "User\LogoutController",
            "logout"
        ],
        "user_emailConfirmation" => [
            "emailConfirmation:token",
            "GET",
            "User\EmailConfirmationController",
            "emailConfirmation"
        ],
        "user_forgotPassword" => [
            "forgotPassword",
            "GET|POST",
            "User\ForgotPasswordController",
            "forgotPassword"
        ],
        "user_resetPassword" => [
            "resetPassword:token",
            "GET|POST",
            "User\ResetPasswordController",
            "resetPassword"
        ],
    ];

    /**
     * routes spéciales
     *
     * @var array<int, array<int, string|null>>
     */
    private static $specialRoutes = [
        "404" => [
            null, 
            "GET",
            "ErrorController",
            "error404"
        ]
    ];

    /**
     * Créer et configurer l'objet Routeur
     *
     * @param string $currentPath
     * @param string $currentMethod
     */
    public function __construct(string $currentPath, string $currentMethod)
    {
        $this->currentPath = $currentPath;
        $this->currentMethod = $currentMethod;
    }

    /**
     * Envoyez la demande au bon contrôleur
     *
     * @return string la page correspondant à la route 
     */
    public function dispatch()
    {
        $routeFound = null;
        $matchedValues = [];

        foreach (self::$routes as $routeData) {
            // Récupérer le chemin de la route et les méthodes autorisées
            $routePath = $routeData[0]; // Exemple: "register"
            $routeAllowedMethod = $routeData[1]; // Exemple: "GET|POST"

            // Transformer le chemin de la route en regex
            $pattern = str_replace('/', '\\/', $routePath); // Remplacer '/' par '\/'
            $pattern = preg_replace('#:' . self::PARAM_REGEX . '#', '(?<$1>[^\/]+)', $pattern); // Remplacer les paramètres de la route en utilisant '#' comme délimiteur
      
            // Vérifier si currentPath correspond à la route et extraire les paramètres s'il y en a
            if (preg_match('#^\/' . $pattern . '\/?$#', $this->currentPath, $matchedValues) && preg_match("/{$this->currentMethod}/", $routeAllowedMethod)) {
                // On a trouvé une route qui correspond à la demande
                $routeFound = $routeData;
                break;
            }
        }

        // Si aucune route n'a été trouvée, on utilise la route 404
        if (!$routeFound) {
            $routeFound = self::$specialRoutes["404"];
        }

        // On parcourt les routes déclarées et on cherche une correspondance
        foreach (self::$routes as $routeData) {
            $routePath = $routeData[0];
            $routeAllowedMethod = $routeData[1];

            // Le chemin ne correspond pas avant de le tester
            $pathMatch = false;

            // obtenir le paramètre de la route à partir du chemin de la route (:monParam par exemple)
            preg_match(self::PARAM_REGEX, $routePath, $matchedParams);

            // transformer le chemin de la route en regex
            $pattern = preg_replace(
                '/\//',   # replace "/"
                '\\/', # by "\/"
                $routePath
            );

            // transformer le chemin de la route en regex
            $pattern = preg_replace(
                self::PARAM_REGEX,   # remplace ":parameter"
                '(?<$1>[^\/]+)', # par "(?<parameter>[a-zA-Z][a-zA-Z1-9]*)"
                $pattern ?? ''
            );
            // ici on ajoute les caractères de début et de fin de chaîne
            $pattern = '/^\/' . $pattern . '\/?$/';
           
            // vérifier si currentPath correspond à la route et extraire les paramètres s'il y en a
            $pathMatch = preg_match($pattern, $this->currentPath, $matchedValues);

            if ($pathMatch) {
                // on vérifie que la méthode http est autorisée
                if (preg_match("/{$this->currentMethod}/", $routeAllowedMethod)) {
                    // on a trouvé une route qui correspond à la demande
                    $routeFound = $routeData;
                    break;
                }
            }
        }

        // laissez exécuter la bonne méthode sur le bon contrôleur
        $controller = "App\Controller\\" . $routeFound[2]; // on ajoute le namespace Controller au nom du contrôleur trouvé
        $method = $routeFound[3]; // on récupère le nom de la méthode à exécuter sur le contrôleur

        $controller = new $controller(); // on instancie le contrôleur
        $result = $controller->$method($matchedValues); // on exécute la méthode du contrôleur

        // renvoie le résultat de l'exécution de la méthode du contrôleur
        return $result;
    }

    /**
     * Générer un chemin à partir d'un nom de route et d'arguments
     *
     * @param string $routeName le nom de la route à partir de laquelle générer un chemin
     * @param array <string, string> $routeArgs les arguments à utiliser lors de la construction du chemin (utile pour les routes paramétrées)
     * @return string
     */
    public static function generate($routeName, $routeArgs = []): string
    {
        $route = self::$routes[$routeName];

        if (!$route) {
            throw new Exception('La route ' . $routeName . ' n\'existe pas');
        }

        $routePath = $route[0];

        // vérifier si la route a des paramètres
        $routeHasParam = preg_match(self::PARAM_REGEX, $routePath, $matchedParams);

        if ($routeHasParam) {
            for ($index = 1; $index < sizeof($matchedParams); $index++) {
                $matchedParam = $matchedParams[$index];
                $routeArg = $routeArgs[$matchedParam];

                if (!$routeArg) {
                    throw new Exception('Besoin d\'un ' . $matchedParam . ' valeur pour générer un chemin pour ' . $routeName);
                }

                // remplacer le paramètre par sa valeur
                $routePath = preg_replace(
                    '/:' . $matchedParam . '/',   # remplace le paramètre
                    $routeArg, # par ces valeurs
                    $routePath ?? ''
                );
            }
        }

        return '/' . $routePath;
    }
}