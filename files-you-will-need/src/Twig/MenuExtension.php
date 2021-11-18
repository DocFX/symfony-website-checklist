<?php

declare(strict_types = 1);

namespace App\Twig;

use App\Model\Admin\AdminMenus;
use App\Model\Front\FrontMenus;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    public function __construct(private Environment $environment)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('display_admin_menu', [$this, 'displayAdminMenu'], ['is_safe' => ['html']]),
            new TwigFunction('display_front_main_menu', [$this, 'displayFrontMainMenu'], ['is_safe' => ['html']]),
            new TwigFunction('display_front_second_menu', [$this, 'displayFrontSecondMenu'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function displayAdminMenu(): string
    {
        $menuTree = [];

        if (is_array(AdminMenus::$adminMenuTree)) {
            $menuTree = AdminMenus::$adminMenuTree;
        }

        return $this->environment->render('common/_menu.html.twig', ['menus' => $menuTree, 'base_key' => 'admin']);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function displayFrontMainMenu(): string
    {
        $menuTree = [];

        if (is_array(FrontMenus::$frontMainMenuTree)) {
            $menuTree = FrontMenus::$frontMainMenuTree;
        }

        return $this->environment->render('common/_menu.html.twig', ['menus' => $menuTree, 'base_key' => 'front']);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function displayFrontSecondMenu(): string
    {
        $menuTree = [];

        if (is_array(FrontMenus::$frontSecondMenuTree)) {
            $menuTree = FrontMenus::$frontSecondMenuTree;
        }

        return $this->environment->render('common/_menu.html.twig', ['menus' => $menuTree, 'base_key' => 'front']);
    }
}
