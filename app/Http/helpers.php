<?php
/**
 * @package     ccms
 * @copyright   2017 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Theme
{

    protected $icons = 0;

    function __construct()
    {
        $theme_id = get_option('site_theme');
        if($theme_id !== '') {
            $this->theme = \App\Models\Themes::whereId($theme_id)->first();
        } else {
            $this->theme = 'default';
        }
    }

    /**
     * @param $opt
     *
     * @return null
     */
    function themeOpts($opt)
    {
        $theme = $this->theme;
        if($theme == 'default' || $theme == NULL)
            return NULL;
        return $theme->$opt;
    }

    /**
     * @param string|array $options
     *
     * @return string
     */
    function menu($options = NULL)
    {
        if(is_array($options) && in_array('icons', $options)) {
            $this->icons = 1;
        }
        $html = '';
        $mainMenu = App\Models\MainMenu::whereActive(1)->whereParent(0)->orderBy('order', 'ASC')->get();

        foreach ($mainMenu as $m):
            if($this->icons == 1) {
                $icon = self::fa($m->icon);
            } else {
                $icon = "";
            }
            if(Auth::check() && $m->path == '/login') {
                $m->path = '/logout';
                $m->title = 'Logout';
            }
            if(is_array($options) && in_array('no-submenu', $options)):
                $html .= '<li class="nav-item"><a class="nav-link js-scroll-trigger" href="'.url($m->path).'">'.$icon.$m->title.'</a></li>';
            else:
                if(self::subMenu($m->id) !== '') {
                    $html .= self::subMenu($m->id);
                } else { //list only main items
                    $html .= '<li class="nav-item"><a class="nav-link js-scroll-trigger" href="'.url($m->path).'">'.$icon.$m->title.'</a></li>';
                }
            endif;
        endforeach;

        return $html;
    }


    /**
     * @param $parent
     *
     * @return string
     */
    function subMenu($parent)
    {
        $menu = App\Models\MainMenu::whereActive(1)->whereId($parent)->first();
        $sub_menu = $menu->subMenu()->whereActive(1)->orderBy('order', 'ASC')->get();

        $html = '';

        if(!empty($sub_menu)):
            $html .= '<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">'.$menu->title.'<span class="caret"></span></a>
    <ul class="dropdown-menu">';
            $html .= '<li><a class="nav-item" href="'.url($menu->path).'">'.$menu->title.'</a></li>';

            foreach ($sub_menu as $s) {
                if($this->icons == 1) {
                    $icon = self::fa($s->icon);
                } else {
                    $icon = "";
                }
                if(Auth::check() && $s->path == '/login') {
                    $s->path = '/logout';
                    $s->title = ' Logout';
                }
                $html .= '<li><a class="nav-item" href="'.url($s->path).'">'.$icon.$s->title.'</a></li>';
            }
            $html .= '</ul></li>';
        endif;
        return $html;
    }

    function fa($icon = "")
    {
        return '<i class="fa fa-'.$icon.'"></i> ';
    }
}

/**
 * @param string $opt
 *
 * @return string|Theme
 */
function theme($opt = '')
{
    $theme = new Theme();
    if($opt == '') {
        return $theme;
    } else {
        return $theme->themeOpts($opt);
    }

}

if(!function_exists('str_clean')) {
    function str_clean($string)
    {
        $string = str_replace(['[\',\']'], '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(['/[^A-Za-z0-9-.]/i', '/[-]+/'], '-', $string);
        $string = strip_tags($string);
        return strtolower(trim($string, '-'));
    }
}

/**
 * @param $option
 * @param $value
 *
 * @return bool
 */
function set_option($option_name, $value)
{
    $option = DB::table('sys_options')
        ->where('option_name', $option_name)
        ->first();

    if(!empty($option)) {//option exists, update

        update_option($option_name, $value);

    } else {
        DB::table('sys_options')
            ->insert(
                [
                    'option_name' => $option_name,
                    'option_value' => $value,
                ]
            );
        return TRUE;
    }
    return FALSE;
}

/**
 * @param $option_name
 * @param $value
 *
 * @return bool
 */
function update_option($option_name, $value)
{
    $option = DB::table('sys_options')
        ->where('option_name', $option_name)
        ->update(
            [
                'option_name' => $option_name,
                'option_value' => $value,
            ]
        );

    if($option) return TRUE;

    return FALSE;
}

/**
 * @param $option_name
 *
 * @return string
 */
function get_option($option_name)
{
    $option = DB::table('sys_options')
        ->where('option_name', $option_name)
        ->first();

    if(!empty($option)) return $option->option_value;

    return '';
}

/**
 * @return array
 */
function get_options()
{
    $options = DB::table('sys_options')
        ->where('autoload', 'yes')
        ->get();

    if(!empty($options))
        return $options;

    return [];

}

/**
 * @param $option
 *
 * @return bool
 */
function remove_option($option)
{
    $option = DB::table('sys_options')
        ->where('option_name', $option)
        ->delete();

    if($option) return TRUE;

    return FALSE;
}

if(!function_exists('str_clean')) {
    function str_clean($string)
    {
        $string = str_replace(['[\',\']'], '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(['/[^A-Za-z0-9-.]/i', '/[-]+/'], '-', $string);
        $string = strip_tags($string);
        return strtolower(trim($string, '-'));
    }
}

if(!function_exists('notices')) {
    function notices($type = 'info', $notice = '')
    {
        //todo pass many messages
        session()->flash('message', $notice);
        session()->flash('notice-type', $type);
    }
}

/**
 * check if use has a specified role
 */
if(!function_exists('has_role')) {
    function has_role($role = '')
    {
        if(empty($role)) return FALSE;

        return auth()->check() && auth()->user()->role == $role;
    }
}
