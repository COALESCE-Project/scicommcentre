<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @xara/template-parts/style.html.twig */
class __TwigTemplate_da8bb894ad458833a2bbcfbed963153a extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<style>
";
        // line 3
        echo "body {
  font-size: ";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["body_font_size"] ?? null), 4, $this->source), "html", null, true);
        echo "rem;
}
";
        // line 7
        if ( !($context["main_menu_default"] ?? null)) {
            // line 8
            echo ".menu-wrap ul.menu {
  font-size: ";
            // line 9
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_menu_top_size"] ?? null), 9, $this->source), "html", null, true);
            echo "rem;
}
.menu-wrap {
  font-weight: ";
            // line 12
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_menu_top_weight"] ?? null), 12, $this->source), "html", null, true);
            echo ";
}
.menu-wrap ul.menu > li > a {
  text-transform: ";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_menu_top_transform"] ?? null), 15, $this->source), "html", null, true);
            echo ";
}
.menu-wrap ul.menu ul.submenu {
  fontweight: ";
            // line 18
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_menu_sub_weight"] ?? null), 18, $this->source), "html", null, true);
            echo ";
}
.menu-wrap ul.menu ul.submenu li {
  font-size: ";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_menu_sub_size"] ?? null), 21, $this->source), "html", null, true);
            echo "rem;  
  text-transform: ";
            // line 22
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_menu_sub_transform"] ?? null), 22, $this->source), "html", null, true);
            echo ";
}
";
        }
        // line 25
        echo "@media (min-width: 1170px) {
  .container {
    max-width: ";
        // line 27
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container_width"] ?? null), 27, $this->source), "html", null, true);
        echo "px;
  }
}
";
        // line 31
        if ((($context["header_width"] ?? null) == "header_width_full")) {
            // line 32
            echo ".header-top .container,
.header .container,
.page-header .container {
  width: 100%;
  max-width: 100%;
}
";
        }
        // line 39
        if ((($context["main_width"] ?? null) == "main_width_full")) {
            // line 40
            echo ".main-wrapper .container {
  width: 100%;
  max-width: 100%;
}
";
        }
        // line 45
        echo "
";
        // line 46
        if ((($context["footer_width"] ?? null) == "footer_width_full")) {
            // line 47
            echo ".footer-top footer .container,
.footer-blocks .container,
.footer-bottom-blocks .container,
.footer-bottom .container {
  width: 100%;
  max-width: 100%;
}
";
        }
        // line 56
        echo ".region-page-header {
  align-items: ";
        // line 57
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["header_page_content_position"] ?? null), 57, $this->source), "html", null, true);
        echo ";
}

@media (min-width: 768px) {
  ";
        // line 61
        if ( !($context["sidebar_width_default"] ?? null)) {
            // line 62
            echo "  .sidebar-left #main {
    flex: 1 1 calc(100% - ";
            // line 63
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_width_left"] ?? null), 63, $this->source), "html", null, true);
            echo "%);
  }
  .sidebar-right #main {
    flex: 1 1 calc(100% - ";
            // line 66
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_width_right"] ?? null), 66, $this->source), "html", null, true);
            echo "%);
  }
  .two-sidebar #main {
    flex: 1 1 calc(100% - ";
            // line 69
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_width_left"] ?? null), 69, $this->source), "html", null, true);
            echo "% - ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_width_right"] ?? null), 69, $this->source), "html", null, true);
            echo "%);
  }
  #sidebar-left {
    flex: 0 1 ";
            // line 72
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_width_left"] ?? null), 72, $this->source), "html", null, true);
            echo "%;
  }
  #sidebar-right {
    flex: 0 1 ";
            // line 75
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_width_right"] ?? null), 75, $this->source), "html", null, true);
            echo "%;
  }
  ";
        }
        // line 78
        echo "}
";
        // line 80
        if ( !($context["page_title_default"] ?? null)) {
            // line 81
            echo ".page-title {
  font-size: ";
            // line 82
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_title_size"] ?? null), 82, $this->source), "html", null, true);
            echo "rem;
  text-transform: ";
            // line 83
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_title_transform"] ?? null), 83, $this->source), "html", null, true);
            echo ";
}
";
        }
        // line 86
        if (($context["highlight_author_comment"] ?? null)) {
            // line 87
            echo ".comment-by-author {
  box-shadow: 0 0 6px 1px var(--secondary);
}
";
        }
        // line 91
        echo "</style>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["body_font_size", "main_menu_default", "main_menu_top_size", "main_menu_top_weight", "main_menu_top_transform", "main_menu_sub_weight", "main_menu_sub_size", "main_menu_sub_transform", "container_width", "header_width", "main_width", "footer_width", "header_page_content_position", "sidebar_width_default", "sidebar_width_left", "sidebar_width_right", "page_title_default", "page_title_size", "page_title_transform", "highlight_author_comment"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@xara/template-parts/style.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  207 => 91,  201 => 87,  199 => 86,  193 => 83,  189 => 82,  186 => 81,  184 => 80,  181 => 78,  175 => 75,  169 => 72,  161 => 69,  155 => 66,  149 => 63,  146 => 62,  144 => 61,  137 => 57,  134 => 56,  124 => 47,  122 => 46,  119 => 45,  112 => 40,  110 => 39,  101 => 32,  99 => 31,  93 => 27,  89 => 25,  83 => 22,  79 => 21,  73 => 18,  67 => 15,  61 => 12,  55 => 9,  52 => 8,  50 => 7,  45 => 4,  42 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@xara/template-parts/style.html.twig", "C:\\xampp\\htdocs\\scicommcentre\\web\\themes\\xara\\templates\\template-parts\\style.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 7);
        static $filters = array("escape" => 4);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
