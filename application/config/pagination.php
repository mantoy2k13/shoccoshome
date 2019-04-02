<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** PAGINATION Custom class**/

$config = array(
    'full_tag_open' => '<ul class="pagination">',
    'full_tag_close' => '</ul>',
    'first_tag_open' => '<li class="page-item">',
    'first_tag_close' => '</a></li>',
    'last_tag_open' => '<li class="page-item">',
    'last_tag_close' => '</li>',
    'next_link' => 'Next',
    'next_tag_open' => '<li class="page-item">',
    'next_tag_close' => '</li>',
    'prev_link' => 'Previous',
    'prev_tag_open' => '<li class="page-item">',
    'prev_tag_close' => '</li>',
    'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="javascript:;">',
    'cur_tag_close' => '</a></li>',
    'num_tag_open' => '<li class="page-item">',
    'num_tag_close' => '</li>',
    'num_links' => 2,
    'attributes' =>  array('class' => 'page-link'),
);