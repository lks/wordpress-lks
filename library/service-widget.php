<?php class MesArticlesRecents extends WP_Widget {
 
    //Constructeur
    function MesArticlesRecents()
    {
        parent::WP_Widget(false, $name = 'Mes Articles Récents', array('name' => 'Mes Articles Récents', 'description' => 'Affichage des derniers articles du blog'));
    }
 
    //Affichage du widget
    function widget($args, $instance)
    {
        //Récupération des paramètres
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $nb_posts = $instance['nb_posts'];
         
        //Récupération des articles
        $lastposts = get_posts(array('post_type'=>"service_post_type"));
     
        //Affichage
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        else
            echo $before_title . 'Articles Récents' . $after_title;
             
        echo '<ul>';
        foreach ( $lastposts as $post ) : 
            setup_postdata($post); ?>
            <li><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li>
        <?php endforeach;
        echo '</ul>';
        echo $after_widget;
    }
 
    //Mise à jour des paramètres du widget
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
 
        //Récupération des paramètres envoyés
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['nb_posts'] = $new_instance['nb_posts'];
 
        return $instance;
    }
 
    //Affichage des paramètres du widget dans l'admin
    function form($instance)
    {
        $title = esc_attr($instance['title']);
        $nb_posts = esc_attr($instance['nb_posts']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo 'Titre:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('nb_posts'); ?>">
                <?php echo 'Nombre d\'articles:'; ?>
                <input class="widefat" id="<?php echo $this->get_field_id('nb_posts'); ?>" name="<?php echo $this->get_field_name('nb_posts'); ?>" type="text" value="<?php echo $nb_posts; ?>" />
            </label>
        </p>
    <?php
    }
}
 
function dfr_register_widget() {
    register_widget( 'MesArticlesRecents' );
}
add_action('widgets_init', 'dfr_register_widget');

?>