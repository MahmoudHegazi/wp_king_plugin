<?php
// get makes by year
function my_author_box(){

  // get makes by year

  function get_makes_for_year($year) {
  function get_makes_by_year($year) {
  global $wpdb;
  $tablename=$wpdb->base_prefix . "cli_cars";
  $makes = $wpdb->get_results("SELECT id, make FROM $tablename WHERE year = '$year'");
  return $makes;
  }

  $all_makes = get_makes_by_year($year);
  $html_message = '';
  foreach ($all_makes as $value) {
    $html_message .= '<option>' . $value->make . '</option>';
  }
  return $html_message;
  }


   $args = array(
    'year' => $_REQUEST['year']
   );

   // step1 return all makes for gotton year  my_dynamic_models
   $makes_options = get_makes_for_year($args['year']);
   echo $makes_options;
   die();
}
add_action( 'wp_ajax_my_author_box', 'my_author_box' );
add_action( 'wp_ajax_nopriv_my_author_box', 'my_author_box' );





// get models by make
function my_dynamic_models(){

  // get models by make

  // function get models for make and year

  function get_models_for_make_year($year, $make) {
  function get_models_by_makeyear($year, $make) {
  global $wpdb;
  $tablename=$wpdb->base_prefix . "cli_cars";
  $models = $wpdb->get_results("SELECT id, model FROM $tablename WHERE year = '$year' AND make='$make'");
  return $models;
  }

  $all_models = get_models_by_makeyear($year, $make);
  $html_message = '';
  foreach ($all_models as $value) {
    $html_message .= '<option>' . $value->model . '</option>';
  }
  return $html_message;
  }

   $args = array(
    'year' => $_REQUEST['year'],
    'make' => $_REQUEST['make']
   );

   // step1 return all makes for gotton year  my_dynamic_models my_tire_width
   $modelss_options = get_models_for_make_year($args['year'], $args['make']);
   echo $modelss_options;
   die();
}
add_action( 'wp_ajax_my_dynamic_models', 'my_dynamic_models' );
add_action( 'wp_ajax_nopriv_my_dynamic_models', 'my_dynamic_models' );





// 3 get tire width using year, make, model
function my_tire_width(){

  //////////////////////////// finall result
  // function get tire_size for make and year and model

  function get_size_for_make_year_mdoel($year, $make, $model) {
  global $wpdb;
  $tablename=$wpdb->base_prefix . "cli_cars";
  $x = $wpdb->get_results("SELECT id, tire_width FROM $tablename WHERE year = '$year' AND make='$make' AND model='$model'");
  return $x[0]->tire_width;
  }


   $args = array(
    'year' => $_REQUEST['year'],
    'make' => $_REQUEST['make'],
    'model' => $_REQUEST['model']
   );

   // step1 return all makes for gotton year  my_dynamic_models my_tire_width
   $tire_width_result = get_size_for_make_year_mdoel($args['year'], $args['make'], $args['model']);
   echo $tire_width_result;
   die();
}
add_action( 'wp_ajax_my_tire_width', 'my_tire_width' );
add_action( 'wp_ajax_my_tire_width', 'my_tire_width' );



?>
