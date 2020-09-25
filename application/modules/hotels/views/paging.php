<?php

$config['div']         = '#avail_hotels'; //Div tag id
$config['base_url']     = site_url().'/hotels/'.$ajax_function;
$config['total_rows']    = $TotalRec;
$config['per_page']     = $perPage;
$config['postVar']     = 'page';

$minPr = '';
$maxPr = '';
if(@$minPrice && @$maxPrice)
{
    $minPr = $minPrice;
    $maxPr = $maxPrice;
}

$starR = '';
if(@$starRating && $starRating != '')
{
    $starR = $starRating;   
}

$loc = '';
if(@$location && $location != '')
{
    $loc = $location;   
}

$hotName = '';
if(@$hotelName && $hotelName != '')
{
    $hotName = $hotelName;   
}

$config['additional_param']     = "{'sessionId' : '$sessionId', 'minPrice' : '$minPr', 'maxPrice' : '$maxPr', 'starRating' : '$starR', 'hotelName' : '$hotName', 'location' : '$loc'}";

/*//pagination customization using bootstrap styles
  $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul class="page_test">'; // I added class name 'page_test' to used later for jQuery
  $config['full_tag_close'] = '</ul></div><!--pagination-->';
  $config['first_link'] = '&laquo; First';
  $config['first_tag_open'] = '<li class="prev page">';
  $config['first_tag_close'] = '</li>';

  $config['last_link'] = 'Last &raquo;';
  $config['last_tag_open'] = '<li class="next page">';
  $config['last_tag_close'] = '</li>';

  $config['next_link'] = 'Next &rarr;';
  $config['next_tag_open'] = '<li class="next page">';
  $config['next_tag_close'] = '</li>';

  $config['prev_link'] = '&larr; Previous';
  $config['prev_tag_open'] = '<li class="prev page">';
  $config['prev_tag_close'] = '</li>';

  $config['cur_tag_open'] = '<li class="active"><a href="">';
  $config['cur_tag_close'] = '</a></li>';

  $config['num_tag_open'] = '<li class="page">';
  $config['num_tag_close'] = '</li>';*/

$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
$config['full_tag_close'] = '</ul>';
$config['prev_link'] = '&lt;';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = '&gt;';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="current"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
 
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
 
$config['first_link'] = '&lt;&lt;';
$config['last_link'] = '&gt;&gt;';

 
$this->ajax_pagination->initialize($config);
echo $this->ajax_pagination->create_links();