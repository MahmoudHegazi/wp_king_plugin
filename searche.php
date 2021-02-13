<?php
// function to get all  years

function get_all_years() {
function create_year_options() {
global $wpdb;
$tablename=$wpdb->base_prefix . "cli_cars";
$years = $wpdb->get_results("SELECT id, year FROM $tablename");
return $years;
}

$all_years = create_year_options();
$html_message = '<option value="">Year</option>';
foreach ($all_years as $value) {
  $html_message .= '<option value="' . $value->year .'">' . $value->year . '</option>';
}
return $html_message;
}
?>

<select id="myyear" class="year-value">
  <?php echo get_all_years(); ?>
</select>

<select id="mymakes" class="make-value">
  <option value="">Make</option>
</select>

<select id="mymodels" class="model-value">
  <option value="">Model</option>
</select>

<p id="tire_width" style="background:lightblue;padding:30px;width:150px;font-size:1.2em;font-family:lemon;display:none"></p>
    <script>

     // get dynamic makes ajax if you not advanced developer do not edit this
     jQuery(".year-value").on("change", function(){
       $('#mymakes').html('<option value="">Make</option>');
       $('#mymodels').html('<option value="">Model</option>');
       $("#tire_width").css("display","none");
       var year = jQuery(this).val();
      //var year = jQuery(this).attr("data-year");
      //var make = jQuery(this).attr("data-make");
      //var model = jQuery(this).attr("data-model");
      jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", {action: "my_author_box", year: year}, function(response){
       console.log("Response: " + response);
       var static_option1 = '<option value="">Make</option>';
       var full_result1 = static_option1 + response;
       $('#mymakes').html(full_result1);
       //NOTE that 'action' MUST be the same as PHP function name you want to fire
       //you can do whatever you want here with your response
      });
     })

     // get dynamic models ajax if you not advanced developer do not edit this
     jQuery(".make-value").on("change", function(){
       $('#mymodels').html('<option value="">Model</option>');
       $("#tire_width").css("display","none");
       var year = $('#myyear').val();
       var make = jQuery(this).val();
      //var year = jQuery(this).attr("data-year");
      //var make = jQuery(this).attr("data-make");
      //var model = jQuery(this).attr("data-model");
      jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", {action: "my_dynamic_models", year:year, make: make}, function(response){
       console.log("Response: " + response);
       var static_option2 = '<option value="">Model</option>';
       var full_result2 = static_option2 + response;
       $('#mymodels').html(full_result2);
       //NOTE that 'action' MUST be the same as PHP function name you want to fire
       //you can do whatever you want here with your response
      });
     })


     // get result size with advanced way and better UX no need to click any thing
     jQuery(".model-value").on("change", function(){
       $("#tire_width").css("display","block");
       var year = $('#myyear').val();
       var make = $('#mymakes').val();
       var model = jQuery(this).val();
      //var year = jQuery(this).attr("data-year");
      //var make = jQuery(this).attr("data-make");
      //var model = jQuery(this).attr("data-model");
      jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", {action: "my_tire_width", year:year, make: make, model:model}, function(response){
       console.log("Response: " + response);
       $('#tire_width').text(response);
       //NOTE that 'action' MUST be the same as PHP function name you want to fire
       //you can do whatever you want here with your response
      });
     })
    </script>
