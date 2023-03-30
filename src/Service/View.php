<?php

namespace Service;

use Exception;

/**
 * Le moteur de template
 */
class View
{
    /**
     * Chemin où se trouvent les fichiers de template
     *
     * @var string
     */
    private static $TEMPLATE_PATH = __DIR__ . "/../template/";

    /**
     * Renvoie le résultat d'un template traitant les données qui lui sont données
     *
     * @param string $templateName le nom du fichier template à traiter
     * @param array $vars les variables disponibles pour le template
     * @return string le template traité
     */
    public static function returnTemplate(string $templateName, array $vars = [])
    {
        if (file_exists(self::$TEMPLATE_PATH . $templateName . ".php")) { // On vérifie que le template existe
            extract($vars); // On extrait les variables pour les rendre accessibles dans le template
            ob_start(); // On démarre la temporisation de sortie (le template sera stocké dans une variable)
            include(self::$TEMPLATE_PATH . $templateName . ".php"); // On inclut le template
            $template = ob_get_clean(); // On récupère le template et on arrête la temporisation de sortie
        } else {
            throw new Exception("Aucun template trouvé pour le nom " . $templateName, 20);
        }
        return $template;
    }

    /**
     * Helper pour générer un chemin à partir d'un template à l'aide du routeur
     *
     * @param string $routeName le nom de la route
     * @param array $routeArgs les arguments pour générer dynamiquement le chemin
     * @return string le chemin généré
     */
    private static function generateUrl($routeName, $routeArgs = [])
    {
        return Router::generate($routeName, $routeArgs);
    }
}