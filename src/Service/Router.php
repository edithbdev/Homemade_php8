<?php

namespace Service;

use Exception;

class Router
{
    /**
     * regex pour calculer un paramètre de route
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
     * @var array
     */
    private static $routes = [
        "main_index" => [
            "",
            "GET",
            "MainController",
            "index"
        ],
    ];

    /**
     * routes spéciales
     *
     * @var array
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

        // On parcourt les routes déclarées et on cherche une correspondance
        foreach (self::$routes as $routeData) {
            $routePath = $routeData[0];
            $routeAllowedMethod = $routeData[1];

            // Le chemin ne correspond pas avant de le tester
            $pathMatch = false;

            // a - obtenir le paramètre de la route à partir du chemin de la route (:monParam par exemple)
            preg_match(self::PARAM_REGEX, $routePath, $matchedParams);

            // b - transformer le chemin de la route en regex
            $pattern = preg_replace(
                '/\//',   # replace "/"
                '\\/', # by "\/"
                $routePath
            );

            $pattern = preg_replace(
                self::PARAM_REGEX,   # remplace ":parameter"
                '(?<$1>[^\/]+)', # par "(?<parameter>[a-zA-Z][a-zA-Z1-9]*)"
                $pattern
            );

            $pattern = '/^\/' . $pattern . '\/?$/';

            // c - vérifier si currentPath correspond à la route et extraire les paramètres s'il y en a
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

        // Si aucune route n'a été trouvée, on utilise la route 404
        if (!$routeFound) {
            $routeFound = self::$specialRoutes["404"];
        }

        // laissez exécuter la bonne méthode sur le bon contrôleur
        $controller = "Controller\\" . $routeFound[2]; // on ajoute le namespace Controller au nom du contrôleur trouvé
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
     * @param array $routeArgs les arguments à utiliser lors de la construction du chemin (utile pour les routes paramétrées)
     * @return string
     */
    public static function generate($routeName, $routeArgs = [])
    {
        $route = self::$routes[$routeName];

        if (!$route) {
            throw new Exception('La route ' . $routeName . ' n\'existe pas');
        }

        $routePath = $route[0];

        $routeHasParam = preg_match(self::PARAM_REGEX, $routePath, $matchedParams);

        if ($routeHasParam) {
            for ($index = 1; $index < sizeof($matchedParams); $index++) {
                $matchedParam = $matchedParams[$index];
                $routeArg = $routeArgs[$matchedParam];

                if (!$routeArg) {
                    throw new Exception('Besoin d\'un ' . $matchedParam . ' valeur pour générer un chemin pour ' . $routeName);
                }

                $routePath = preg_replace(
                    '/:' . $matchedParam . '/',   # remplace le paramètre
                    $routeArg, # par ces valeurs
                    $routePath,
                );
            }
        }

        return '/' . $routePath;
    }
}