<?php 

/**
* Widget to display my last service. This widget is concepted with responsive design constraint.
* @author lks
*
*/
class MyLastServices extends WP_Widget {
 
    /**
    * Constructor
    */
    function MyLastServices()
    {
        parent::WP_Widget(false, $name = 'Mes derniers services', array('name' => 'Mes derniers services', 'description' => 'Affichage des derniers articles du blog'));
    }
 
    /**
    * Display the widget with the settings parameters
    */
    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $nb_posts = $instance['nb_posts'];
        $lastposts = get_posts(array('post_type'=>"service_post_type"));
     
        //display items
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        else
            echo $before_title . 'My last services' . $after_title;
             
        echo '<ul>';
        foreach ( $lastposts as $post ) : 
            setup_postdata($post); ?>
            <li class="four columns">
                <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
            </li>
        <?php endforeach;
        echo '</ul>';
        echo $after_widget;
    }
 
    /**
    * Update parameters of this widget
    */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
 
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['nb_posts'] = $new_instance['nb_posts'];
 
        return $instance;
    }
 
    /**
    * Form to get parameters
    */
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
    register_widget( 'MyLastServices' );
}
add_action('widgets_init', 'dfr_register_widget');

?>