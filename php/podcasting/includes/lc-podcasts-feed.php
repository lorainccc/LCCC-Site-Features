<?php
        // Feed Details

        /**
         * Add an itunes podcasting header.
         */
        function lc_xmlns() {
            echo "\n" . 'xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"' . "\n";
        }
        add_action( 'rss2_ns', 'lc_xmlns' );


        /**
         * Get the current term, verifying that is has a term_id.
         *
         * @return object WP_Term or false if not a term feed.
         */
        function lc_get_the_term() {
            $queried_object = get_queried_object();
            if ( ! $queried_object || ! $queried_object->term_id ) {
                return false;
            }
            return $queried_object;
        }

        /**
         * Adjust the title for podcasting feeds.
         *
         * @param  string $output The feed title.
         *
         * @return string         The adjusted feed title.
         */
        function lc_bloginfo_rss_name( $output ) {
            $term = lc_get_the_term();
            if ( ! $term ) {
                return $output;
            }
            $title = get_term_meta( $term->term_id, 'lcpodcasts_title', true );
            if ( empty( $title ) ) {
                $title = get_bloginfo( 'name' );
                $title = "$title &#187; {$term->name}";
            } else {
                $output = $title;
            }

            return $output;
        }
        add_filter( 'wp_title_rss', 'lc_bloginfo_rss_name' );

        // Don't show audio widgets in the feed.
        add_filter( 'wp_audio_shortcode', '__return_empty_string', 999 );

        /**
         * Sets the podcast language in the feed to the one selected in the term edit screen.
         *
         * @param string $output    The value being displayed
         * @param string $requested The item that was requested
         *
         * @return mixed
         */
        function lc_bloginfo_rss_lang( $output, $requested ) {
            $term = lc_get_the_term();
            if ( ! $term ) {
                return $output;
            }

            if ( 'language' === $requested ) {
                $lang = get_term_meta( $term->term_id, 'lc_podcasting_language', true );
                if ( $lang ) {
                    $output = $lang;
                }
            }
            return $output;
        }
        add_filter( 'bloginfo_rss', 'lc_bloginfo_rss_lang', 10, 2 );

       /**
         * Add podcasting details to the feed header.
         */
        function lc_feed_head() {
            $term = lc_get_the_term();
            if ( ! $term ) {
                return;
            }
            $subtitle = get_term_meta( $term->term_id, 'lc_podcasting_subtitle', true );

            if ( empty( $subtitle ) ) {
                $subtitle = get_bloginfo( 'description' );
            }

            if ( ! empty( $subtitle ) ) {
                echo '<itunes:subtitle>' . esc_html( wp_strip_all_tags( $subtitle ) ) . "</itunes:subtitle>\n";
            }

            $summary = get_term_meta( $term->term_id, 'lc_podcasting_summary', true );

            if ( empty( $summary ) ) {
                $summary = get_bloginfo( 'description' );
            }

            if ( ! empty( $summary ) ) {
                echo '<itunes:summary>' . esc_html( wp_strip_all_tags( $summary ) ) . "</itunes:summary>\n";
            }

            $author = get_term_meta( $term->term_id, 'lc_podcasting_talent_name', true );
            if ( ! empty( $author ) ) {
                echo '<itunes:author>' . esc_html( wp_strip_all_tags( $author ) ) . "</itunes:author>\n";
            }

            echo '<itunes:owner>';

            if ( ! empty( $author ) ) {
                echo '<itunes:name>' . esc_html( wp_strip_all_tags( $author ) ) . "</itunes:name>\n";
            }

            $podcasting_email = get_term_meta( $term->term_id, 'lc_podcasting_email', true );
            $email            = ! empty( $podcasting_email ) ? $podcasting_email : get_bloginfo( 'admin_email' );
            if ( ! empty( $email ) ) {
                echo '<itunes:email>' . esc_html( wp_strip_all_tags( $email ) ) . "</itunes:email>\n";
            }

            echo '</itunes:owner>';

            $copyright = get_term_meta( $term->term_id, 'lc_podcasting_copyright', true );

            if ( ! empty( $copyright ) ) {
                echo '<copyright>' . esc_html( wp_strip_all_tags( $copyright ) ) . "</copyright>\n";
            }

            $explicit = get_term_meta( $term->term_id, 'lc_podcasting_explicit', true );

            echo '<itunes:explicit>';

            if ( empty( $explicit ) ) {
                echo 'no';
            } else {
                $explicit_code = esc_html( $explicit );
                switch( $explicit_code ) {
                    case "0":
                        echo 'no';
                    break;
                    case "1":
                        echo 'yes' ;
                    break;
                    case "2":
                        echo 'clean';
                    break;
                }
            }

            echo "</itunes:explicit>\n";

            $image = get_term_meta( $term->term_id, 'lc_podcasting_image', true );

            if ( ! empty( $image ) ) {
                echo "<itunes:image href='" . str_replace( 'https://', 'http://', esc_url( wp_get_attachment_url( $image ) ) ) . "' />\n";
            }

            $keywords = get_term_meta( $term->term_id, 'lc_podcasting_keywords', true );

            if ( ! empty( $keywords ) ) {
                echo '<itunes:keywords>' . esc_html( $keywords ) . "</itunes:keywords>\n";
            }

            lc_generate_categories();
        }
        add_action( 'rss2_head', 'lc_feed_head' ); 

        /**
         * Output the feed for a single podcast.
         */
        function lc_feed_item() {
            global $post;
            $term = lc_get_the_term();
            if ( ! $term ) {
                return false;
            }

            $author = get_option( 'lc_podcasting_talent_name' );
            if ( empty( $author ) ) {
                $author = get_the_author();
            }

            echo '<itunes:author>' . esc_html( $author ) . "</itunes:author>\n";

            $explicit = get_post_meta( $post->ID, 'lc_podcast_explicit', true );

            // fall back to the podcast setting
            if ( empty( $explicit ) ) {
                $explicit = get_term_meta( $term->term_id, 'lc_podcasting_explicit', true );
            }

            echo '<itunes:explicit>';

            if ( empty( $explicit ) ) {
                echo 'no';
            } else {
                echo esc_html( $explicit );
            }

            echo "</itunes:explicit>\n";

            $captioned = get_post_meta( $post->ID, 'lc_podcast_captioned', true );

            if ( $captioned ) {
                echo "<itunes:isClosedCaptioned>Yes</itunes:isClosedCaptioned>\n";
            }

            // Add the featured image if available.
            if ( has_post_thumbnail( $post->ID ) ) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
                if ( ! empty( $image ) ) {
                    if ( is_array( $image ) ) {
                        $image = $image[0];
                    }
                    echo "<itunes:image href='" . str_replace( 'https://', 'http://', esc_url( $image ) ) . "' />\n";
                }
            }

            // @todo add a filter here
            $keywords = '';
            if ( ! empty( $keywords ) ) {
                echo '<itunes:keywords>' . esc_html( $keywords ) . "</itunes:keywords>\n";
            }

            if ( has_excerpt() ) {
                $excerpt = get_the_excerpt();
            } else {
                $excerpt = get_term_meta( $term->term_id, 'lc_podcasting_summary', true );
            }
            $excerpt = apply_filters( 'the_excerpt_rss', $excerpt );

            echo '<itunes:summary>' . esc_html( wp_strip_all_tags( $excerpt ) ) . "</itunes:summary>\n";

            $subtitle = wp_trim_words( $excerpt, 10, '&#8230;' );

            echo '<itunes:subtitle>' . esc_html( $subtitle ) . "</itunes:subtitle>\n";

            // Add an enclosure duration if available.
            $duration = get_post_meta( $post->ID, 'lc_podcast_duration', true );
            if ( ! empty( $duration ) ) {
                echo '<itunes:duration>' . esc_html( $duration ) . "</itunes:duration>\n";
            }
        }
        add_action( 'rss2_item', 'lc_feed_item' );

        /**
         * Adjust the enclosure feed for podcasts.
         *
         * @param  string $enclosure The enclosure (media url).
         *
         * @return string            The adjusted enclosure.
         */
        function lc_rss_enclosure( $enclosure ) {
            global $post;

            $podcast_url = get_post_meta( $post->ID, 'lc_podcast_url', true );
            $podcast_filesize = get_post_meta( $post->ID, 'lc_podcast_filesize', true );
            $podcast_mime = get_post_meta( $post->ID, 'lc_podcast_mime', true );

            if ( ! empty( $podcast_url ) ) {

                $enclosure = "<enclosure url='" .
                esc_url( str_replace( 'https://', 'http://', $podcast_url ) ) .
                "' length='" .
                esc_attr( $podcast_filesize ) .
                "' type='" .
                esc_attr( $podcast_mime ) .
                "' />\n";
            }

            return $enclosure;
        }
        add_filter( 'rss_enclosure', 'lc_rss_enclosure' );    

        /**
         * Generate the category elements from the given option (e.g. podcasting_category_1).
         */
        function lc_generate_categories() {
            $term = lc_get_the_term();
            if ( ! $term ) {
                return false;
            }

            $categories[] = get_term_meta( $term->term_id, 'lc_podcasting_category_1', true );
            $categories[] = get_term_meta( $term->term_id, 'lc_podcasting_category_2', true );
            $categories[] = get_term_meta( $term->term_id, 'lc_podcasting_category_3', true );

            $categories = array_filter( $categories );

            $reduced_categories = array();

            foreach ( $categories as $category ) {
                $category = explode( ':', $category );

                if ( ! isset( $reduced_categories[ $category[0] ] ) ) {
                    $reduced_categories[ $category[0] ] = array();
                }

                if ( ! empty( $category[1] ) ) {
                    $reduced_categories[ $category[0] ][] = $category[1];
                }
            }

            $categories = lc_get_podcasting_categories();

            foreach ( $reduced_categories as $parent => $subs ) {
                if ( ! isset( $categories[ $parent ] ) ) {
                    continue;
                }

                if ( empty( $subs ) ) {
                    echo '<itunes:category text="' . esc_html( $categories[ $parent ]['name'] ) . "\" />\n";
                } else {
                    echo '<itunes:category text="' . esc_html( $categories[ $parent ]['name'] ) . "\">\n";

                    foreach ( $subs as $sub ) {
                        if ( ! isset( $categories[ $parent ]['subcategories'][ $sub ] ) ) {
                            continue;
                        }

                        echo "\t<itunes:category text=\"" . esc_html( $categories[ $parent ]['subcategories'][ $sub ] ) . "\" />\n";
                    }

                    echo "</itunes:category>\n";
                }
            }
        }

    /**
     * Ensure the excerpt is actually used for the excerpt.
     *
     * @param  string $output The excerpt.
     *
     * @return string         The filtered excerpt.
     */
    function lc_empty_rss_excerpt( $output ) {
        $excerpt = get_the_excerpt();

        if ( empty( $excerpt ) ) {
            return '';
        }

        return $output;
    }
    // Run it super late after any other filters may have inserted something.
    add_filter( 'the_excerpt_rss', 'lc_empty_rss_excerpt', 1000 );

    function lc_feed_item_content( $content )
    {
        global $post;

        if ( ! is_feed() )
            return $content;

        // Remove all shortcodes
        $content = strip_shortcodes( $post->post_content );

    return $content;
    }

    add_filter('the_excerpt_rss', 'lc_feed_item_content', 99);
    add_filter('the_content', 'lc_feed_item_content', 99);