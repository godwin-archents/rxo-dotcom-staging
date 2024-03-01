<?php

/**
 * Block Name: Program Tiers
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$uid = $block['anchor'] ?? 'rxo-block-' . str_replace('block_', '', $block['id']);

$className = 'rxo-block-' . str_replace('acf/rxo-acf-', '', $block['name']);
// $className .= ' ' . $block['className'] ?? '';
// $className .= ' ' . $block['align'] ?? '';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

if( !empty($block['align']) ) {
    $className .= ' ' . $block['align'];
}

$theme = get_field('theme');
$className .= ($theme === 'dark') ? ' text-bg-black dark-theme' : (($theme === 'gray') ? ' text-bg-light gray-theme' : '');
$id = $args['id'];
?>

<div id="<?= $uid; ?>" class="<?= $className; ?>">
    <div class="container position-relative py-6">
        <div class="row">        
            <?php while (have_rows('rewards_fields')) : the_row();

                $star_rating = get_sub_field('star_rating');
                $star_rating_color = get_sub_field('star_rating_color');
                $reward_name = get_sub_field('reward_name');

                $average_monthly_loads = get_sub_field('average_monthly_loads');
                $minimum_carrier_score = get_sub_field('minimum_carrier_score');

                $benefits_label = get_sub_field('benefits_label');

                $status_bonus = get_sub_field('status_bonus');
                $status_bonus_input = get_sub_field('status_bonus_input');
                
                $quarterly_rewards_tier_bonus = get_sub_field('quarterly_rewards_tier_bonus');
                $quarterly_rewards_tier_bonus_input = get_sub_field('quarterly_rewards_tier_bonus_input');
                
                $extra_fuel_savings = get_sub_field('extra_fuel_savings');
                $extra_fuel_savings_input = get_sub_field('extra_fuel_savings_input');
                
                $maintenance_savings = get_sub_field('maintenance_savings');
                $maintenance_savings_input = get_sub_field('maintenance_savings_input');
                
                $tier_savings = get_sub_field('tier_savings');
                $tier_savings_input = get_sub_field('tier_savings_input');

                switch($star_rating) {
                    case 1:
                        $star_rating = 1;
                        break;
                    case 2:
                        $star_rating = 2;
                        break;
                    case 3:
                        $star_rating = 3;
                        break;
                    case 4:
                        $star_rating = 4;
                        break;
                    case 5:
                        $star_rating = 5;
                        break;
                    default:
                        $star_rating = '';
                }

                switch($reward_name) {
                    case 'Bronze':
                        $rewards_type = 'loads-and-scores--bronze';
                        break;
                    case 'Silver':
                        $rewards_type = 'loads-and-scores--silver';
                        break;
                    case 'Gold':
                        $rewards_type = 'loads-and-scores--gold';
                        break;
                    case 'Platinum':
                        $rewards_type = 'loads-and-scores--platinum';
                        break;
                    default:
                        $rewards_type = '';
                }

                switch($star_rating_color) {
                    case 'Bronze':
                        $rating_icon_color = 'rating-icon--bronze';
                        break;
                    case 'Silver':
                        $rating_icon_color = 'rating-icon--silver';
                        break;
                    case 'Gold':
                        $rating_icon_color = 'rating-icon--gold';
                        break;
                    case 'Platinum':
                        $rating_icon_color = 'rating-icon--platinum';
                        break;
                    default:
                        $rating_icon_color = '';
                } ?>

                <div class="col-12 col-md-6 col-lg-3 pb-3">
                    <div class="py-3 overflow-hidden program-tiers-wrap">
                        <?php 
                        // Show the star rating
                        if(isset($star_rating)) {
                            echo '<div class="rewards-rating">';
                                for($i=1; $i<=$star_rating; $i++) {
                                    echo '<span class="rating-icon '.$rating_icon_color .'">&nbsp;</span>';
                                }
                            echo '</div>';
                        }

                        // Reward Name
                        if(isset($reward_name)) {
                            echo '<h4>'.$reward_name.'</h4>';
                        }

                        // Average Monthly Loads
                        if(isset($average_monthly_loads)) {
                            echo '<div class="loads-and-scores d-flex '.$rewards_type .'"><span class="loads-label">Average Monthly Loads:</span> <strong>'.$average_monthly_loads.'</strong></div>';
                        }

                        // Minimum Carrier Score
                        if(isset($minimum_carrier_score)) {
                            echo '<div class="loads-and-scores d-flex '.$rewards_type .'"><span class="loads-label">Minimum Carrier Score:</span> <strong>'.$minimum_carrier_score.'</strong></div>';
                        } 

                        // Benefits Title
                        if(isset($benefits_label)) {
                            echo '<h5 class="mt-5">'.$benefits_label.'</h5>';
                        }

                        echo '<ul>';

                            // Status Bonus
                            echo '<li class="d-flex"><span class="benefits-label">Status Bonus:</span>';
                            if($status_bonus == 'yes') {
                                echo '<span class="benefits-icon-open"></span>';
                            } elseif($status_bonus == 'no') {
                                echo '<span class="benefits-icon-close"></span>';
                            } else {
                                echo '<strong>'.$status_bonus_input.'</strong>';                        
                            }
                            echo '</li>';

                            // Quarterly Rewards Tier Bonus
                            echo '<li class="d-flex"><span class="benefits-label">Quarterly Rewards Tier Bonus:</span>';
                            if($quarterly_rewards_tier_bonus == 'yes') {
                            echo '<span class="benefits-icon-open"></span>';
                            } elseif($quarterly_rewards_tier_bonus == 'no') {
                                echo '<span class="benefits-icon-close"></span>';
                            } else {
                                echo '<strong>'.$quarterly_rewards_tier_bonus_input.'</strong>';                        
                            }
                            echo '</li>';

                            // Extra Fuel Savings
                            echo '<li class="d-flex"><span class="benefits-label">Extra Fuel Savings:</span>';
                            if($extra_fuel_savings == 'yes') {
                                echo '<span class="benefits-icon-open"></span>';
                            } elseif($extra_fuel_savings == 'no') {
                                echo '<span class="benefits-icon-close"></span>';
                            } else {
                                echo '<strong>'.$extra_fuel_savings_input.'</strong>';
                            }
                            echo '</li>';

                            // Maintenance Savings
                            echo '<li class="d-flex"><span class="benefits-label">Maintenance Savings:</span>';
                            if($maintenance_savings == 'yes') {
                                echo '<span class="benefits-icon-open"></span>';
                            } elseif($maintenance_savings == 'no') {
                                echo '<span class="benefits-icon-close"></span>';
                            } else {
                                echo '<strong>'.$maintenance_savings_input.'</strong>';
                            }
                            echo '</li>';

                            // Tier Savings
                            echo '<li class="d-flex"><span class="benefits-label">Tire Savings:</span>';
                            if($tier_savings == 'yes') {
                                echo '<span class="benefits-icon-open"></span>';
                            } elseif($tier_savings == 'no') {
                                echo '<span class="benefits-icon-close"></span>';
                            } else {
                                echo '<strong>'.$tier_savings_input.'</strong>';                        
                            }
                            echo '</li>';

                        echo '</ul>'; ?>
                    </div>
                </div>
            <?php endwhile; ?>         
        </div>
    </div>
</div>