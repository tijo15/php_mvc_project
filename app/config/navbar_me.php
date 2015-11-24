<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar1',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',
            'url'   => $this->di->get('url')->create('hem'),
            'title' => 'Hem'
        ],
 

              // This is a menu item
        'questions'  => [
            'text'  => 'Frågor',
            'url'   => $this->di->get('url')->create('questions'),
            'title' => 'Frågor'
            ],

                    // This is a menu item
        'tags'  => [
            'text'  => 'Taggar',
            'url'   => $this->di->get('url')->create('tags'),
            'title' => 'Taggar'
            ],

        'users'  => [
            'text'  => 'Användare',
            'url'   => $this->di->get('url')->create('users'),
            'title' => 'Användare',
        
                ],

                     // This is a menu item
        'about'  => [
            'text'  => 'Om oss',
            'url'   => $this->di->get('url')->create('about'),
            'title' => 'Om oss'
            ],

            'logga in'  => [
            'text'  => 'Logga in',
            'url'   => $this->di->get('url')->create('users/login'),
            'title' => 'Logga in'
            ],

              'register'  => [
            'text'  => 'Registrera dig',
            'url'   => $this->di->get('url')->create('users/add'),
            'title' => 'Om oss'
            ],
    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
