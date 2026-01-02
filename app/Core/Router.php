<?php
// Active le mode strict pour les types
declare(strict_types=1);
// Espace de noms du noyau
namespace Mini\Core;
// Déclare le routeur HTTP minimaliste
final class Router
{
    // Tableau des routes : [méthode, chemin, [ClasseContrôleur, action]]
    /** @var array<int, array{0:string,1:string,2:array{0:class-string,1:string}} > */
    private array $routes;

    /**
     * Initialise le routeur avec les routes configurées
     * @param array<int, array{0:string,1:string,2:array{0:class-string,1:string}} > $routes
     */
    public function __construct(array $routes)
    {
        // Mémorise les routes fournies
        $this->routes = $routes;
    }

    // Dirige la requête vers le bon contrôleur en fonction méthode/URI
    public function dispatch(string $method, string $uri): void
    {
        // Extrait uniquement le chemin de l'URI
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        // Parcourt chaque route enregistrée
        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            // Vérifie la correspondance de méthode
            if ($method === $routeMethod) {
                // Essaye de faire correspondre le chemin avec paramètres
                $params = $this->matchRoute($routePath, $path);
                if ($params !== null) {
                    // Déstructure le gestionnaire en [classe, action]
                    [$class, $action] = $handler;
                    // Instancie le contrôleur cible
                    $controller = new $class();
                    // Définit les paramètres de route
                    $controller->setParams($params);
                    // Appelle l'action avec les paramètres
                    $controller->$action($params);
                    return;
                }
            }
        }

        // Si aucune route ne correspond, renvoie un 404 minimaliste
        http_response_code(404);
        echo '404 Not Found';
    }

    /**
     * Fait correspondre un chemin de route avec paramètres à un chemin réel
     * @param string $routePath Chemin de la route (ex: /product/{id})
     * @param string $realPath Chemin réel de la requête (ex: /product/42)
     * @return array<string, string>|null Tableau des paramètres ou null si pas de correspondance
     */
    private function matchRoute(string $routePath, string $realPath): ?array
    {
        // Correspondance stricte (pas de paramètres)
        if ($routePath === $realPath) {
            return [];
        }

        // Convertit le chemin de route en regex
        $pattern = preg_replace_callback(
            '/{(\w+)}/',
            fn($matches) => '(?P<' . $matches[1] . '>[^/]+)',
            $routePath
        );
        $pattern = '#^' . $pattern . '$#';

        // Teste la correspondance avec regex
        if (preg_match($pattern, $realPath, $matches)) {
            // Filtre pour ne garder que les paramètres nommés
            return array_filter($matches, fn($key) => !is_numeric($key), ARRAY_FILTER_USE_KEY);
        }

        return null;
    }
}


