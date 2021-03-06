<?php

namespace App;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public $featured = [
        'big' => [],
        'small' => []
    ];

    public function __construct()
    {
        $this->page_id = get_option('page_on_front');
        $this->setFeatured();
    }

    public function blocks()
    {
        $rows = get_field('content_blocks');
        $return = [];
        if ($rows) {
            $return = array_map(function ($row) {
                return [
                    'title' => $row['title'],
                    'content' => $row['description'],
                    'link' => $row['link'],
                ];
            }, $rows);
        }
       
        return $return;
    }


    public function links()
    {
        $rows = get_field('links');
        $return = [];
        if ($rows) {
            $return = array_map(function ($row) {
                return [
                    'title' => $row['location'],
                    'url' => $row['url'],
                ];
            }, $rows);
        }
       
        return $return;
    }

    public function courses()
    {
        $rows = get_field('courses');
        $return = [];
        if ($rows) {
            $return = array_map(function ($row) {
                $course = get_post($row['course']);
                return [
                    'title' => $course->post_title,
                    'link' => get_permalink($course->ID),
                    'excerpt' => wp_kses_post(wp_trim_words($course->post_content, 40, '...')),
                    'date' =>  date_i18n("j M", get_field("_wcs_timestamp", $course->ID)),
                    'lesson' => get_field("_wcs_sub_title", $course->ID),
                ];
            }, $rows);
        }
        return $return;
    }

    public function courseLink()
    {
        $class_page = get_page_by_title(__('Vrijwilligersacademie', 'mooiwerk'));
        if (!empty($class_page)) {
            return home_url('/'.$class_page->post_name);
        }
        return home_url("/Vrijwilligersacademie");
    }

    public function courseIntro()
    {
        return get_field('course_subtitle');
    }

    public function courseDescription()
    {
        return get_field('course_description');
    }

    public function courseTitle()
    {
        return get_field('course_title');
    }

    public function setFeatured()
    {
        $rows = get_field('featured');
        if (is_array($rows) && count($rows) == 6) {
            foreach ($rows as $row) {
                if ($row['is_big']) {
                    array_push(
                        $this->featured['big'],
                        [
                            'title' => get_the_title($row['post_id']),
                            'excerpt' => $row['excerpt'],
                            'link' => get_permalink($row['post_id']),
                            'image_link' => get_the_post_thumbnail_url($row['post_id'], [500, 500]),
                        ]
                    );
                } else {
                    array_push(
                        $this->featured['small'],
                        [
                            'title' => get_the_title($row['post_id']),
                            'excerpt' => $row['excerpt'],
                            'link' => get_permalink($row['post_id']),
                            'image_link' => get_the_post_thumbnail_url($row['post_id'], [500, 500]),
                        ]
                    );
                }
            }
        } else {
            $this->featured = false;
        }
    }

    public function news()
    {
        if (empty($this->featured)) {
            return [];
        }

        if (count($this->featured['big']) == 2) {
            return $this->featured;
        } elseif (count($this->featured['big']) == 1) {
            array_push($this->featured['big'], array_shift($this->featured['small']));
        } elseif (count($this->featured['big']) > 2) {
            $this->featured['small'] = array_merge($this->featured['small'], array_slice($this->featured['big'], 2));
        } else {
            $this->featured['big'] = array_slice($this->featured['small'], 0, 2);
        }

        return $this->featured;
    }

    public function newsTitle()
    {
        return __('Nieuws', 'mooiwerk-breda-theme');
    }
}
