<?php
/**
 * Reusable pricing plan cards (homepage, hub, and service pages).
 *
 * Expects:
 * - $caaft_pricing_plans (array) — required plan list
 * Optional:
 * - $caaft_pricing_layout — 'simple' (homepage) or 'tiered' (default, service pages)
 * - $caaft_pricing_section_id, $caaft_pricing_heading_id, $caaft_pricing_title
 * - $caaft_pricing_eyebrow, $caaft_pricing_subtitle, $caaft_pricing_col_class
 * - $caaft_pricing_section_class, $caaft_pricing_is_subsection, $caaft_pricing_footnote
 * - $caaft_pricing_cta_label
 */
if (empty($caaft_pricing_plans) || !is_array($caaft_pricing_plans)) {
    return;
}

$caaft_pricing_section_id = $caaft_pricing_section_id ?? 'pricing-plans';
$caaft_pricing_heading_id = $caaft_pricing_heading_id ?? ($caaft_pricing_section_id . '-heading');
$caaft_pricing_title = $caaft_pricing_title ?? 'Transparent <span>Service Packages</span>';
$caaft_pricing_eyebrow = $caaft_pricing_eyebrow ?? 'Pricing Plans';
$caaft_pricing_col_class = $caaft_pricing_col_class ?? 'col-md-6 col-lg-4';
$caaft_pricing_section_class = trim('home3-plans-area py-90 ' . ($caaft_pricing_section_class ?? ''));
$caaft_pricing_is_subsection = !empty($caaft_pricing_is_subsection);
$caaft_pricing_layout = ($caaft_pricing_layout ?? '') === 'simple' ? 'simple' : 'tiered';
$caaft_pricing_cta_label = $caaft_pricing_cta_label ?? 'Get Started';
$caaft_pricing_row_class = count($caaft_pricing_plans) === 2 ? 'justify-content-center' : '';
$caaft_pricing_subtitle_class = $caaft_pricing_is_subsection ? 'caaft-pricing-subtitle' : 'home3-section-lead';
$caaft_pricing_wow_base = $caaft_pricing_is_subsection ? 0.05 : 0.15;
?>
<section class="<?php echo htmlspecialchars($caaft_pricing_section_class, ENT_QUOTES, 'UTF-8'); ?>" id="<?php echo htmlspecialchars($caaft_pricing_section_id, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_pricing_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="site-heading text-center mb-40 wow fadeInUp" data-wow-delay=".1s">
            <?php if (!$caaft_pricing_is_subsection) : ?>
                <span class="site-title-tagline"><i><img src="assets/img/trend-img.webp" alt="" class="img-fluid" width="30" height="30"></i> <?php echo htmlspecialchars($caaft_pricing_eyebrow, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
            <h2 id="<?php echo htmlspecialchars($caaft_pricing_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="site-title mt-2<?php echo $caaft_pricing_is_subsection ? ' caaft-pricing-subsection-title' : ''; ?>"><?php echo $caaft_pricing_title; ?></h2>
            <?php if (!empty($caaft_pricing_subtitle)) : ?>
                <p class="<?php echo htmlspecialchars($caaft_pricing_subtitle_class, ENT_QUOTES, 'UTF-8'); ?> mt-2"><?php echo htmlspecialchars((string) $caaft_pricing_subtitle, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </div>
        <div class="row g-4 align-items-stretch home3-plans-grid <?php echo htmlspecialchars($caaft_pricing_row_class, ENT_QUOTES, 'UTF-8'); ?>">
            <?php foreach ($caaft_pricing_plans as $caaft_plan_index => $caaft_plan) : ?>
                <?php
                $caaft_plan_class = 'home3-plan';
                if (!empty($caaft_plan['featured'])) {
                    $caaft_plan_class .= ' home3-plan--featured';
                }
                $caaft_plan_href = (string) ($caaft_plan['href'] ?? '#quote-content');
                $caaft_plan_cta = (string) ($caaft_plan['cta_label'] ?? $caaft_pricing_cta_label);
                $caaft_plan_is_featured = !empty($caaft_plan['featured']);
                $caaft_plan_wow_delay = number_format($caaft_pricing_wow_base + ($caaft_plan_index * 0.05), 2, '.', '');
                ?>
                <div class="<?php echo htmlspecialchars($caaft_pricing_col_class, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php if ($caaft_pricing_layout === 'simple') : ?>
                        <?php
                        $caaft_simple_badge = (string) ($caaft_plan['badge'] ?? '');
                        $caaft_simple_cta_class = 'home3-plan-cta theme-btn' . ($caaft_plan_is_featured ? '' : ' theme-btn2');
                        $caaft_simple_price_note = (string) ($caaft_plan['price_note'] ?? '');
                        ?>
                        <div class="<?php echo htmlspecialchars($caaft_plan_class, ENT_QUOTES, 'UTF-8'); ?> wow fadeInUp" data-wow-delay="<?php echo $caaft_plan_wow_delay; ?>s">
                            <?php if ($caaft_simple_badge !== '') : ?>
                                <div class="home3-plan-badge"><?php echo htmlspecialchars($caaft_simple_badge, ENT_QUOTES, 'UTF-8'); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($caaft_plan['title'])) : ?>
                                <div class="home3-plan-name"><?php echo htmlspecialchars((string) $caaft_plan['title'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <?php endif; ?>
                            <div class="home3-plan-price">
                                <span class="home3-plan-amount"><span class="home3-plan-rupee" aria-hidden="true">&#8377;</span><?php echo htmlspecialchars((string) $caaft_plan['price'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php if ($caaft_simple_price_note !== '') : ?>
                                    <span class="home3-plan-price-suffix"><?php echo htmlspecialchars($caaft_simple_price_note, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo htmlspecialchars($caaft_plan_href, ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars($caaft_simple_cta_class, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($caaft_plan_cta, ENT_QUOTES, 'UTF-8'); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                            <?php if (!empty($caaft_plan['features']) && is_array($caaft_plan['features'])) : ?>
                                <ul class="home3-plan-features">
                                    <?php foreach ($caaft_plan['features'] as $caaft_plan_feature) : ?>
                                        <?php
                                        $caaft_feature_text = is_array($caaft_plan_feature)
                                            ? (string) ($caaft_plan_feature['text'] ?? '')
                                            : (string) $caaft_plan_feature;
                                        if ($caaft_feature_text === '') {
                                            continue;
                                        }
                                        ?>
                                        <li><i class="fas fa-check" aria-hidden="true"></i><span><?php echo htmlspecialchars($caaft_feature_text, ENT_QUOTES, 'UTF-8'); ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <?php
                        $caaft_plan_cta_class = 'home3-plan-cta theme-btn' . ($caaft_plan_is_featured ? ' home3-plan-cta--featured' : ' home3-plan-cta--standard');
                        $caaft_plan_cta_icon = $caaft_plan_is_featured ? 'fas fa-arrow-right' : 'fas fa-arrow-up-right';
                        $caaft_plan_has_tier = !empty($caaft_plan['tier']);
                        $caaft_plan_has_badge = !empty($caaft_plan['badge']);
                        if ($caaft_plan_has_tier && $caaft_plan_has_badge) {
                            $caaft_plan_badge = (string) $caaft_plan['badge'];
                            $caaft_plan_tier_label = (string) $caaft_plan['tier'];
                        } elseif ($caaft_plan_has_tier) {
                            $caaft_plan_badge = (string) $caaft_plan['tier'];
                            $caaft_plan_tier_label = '';
                        } else {
                            $caaft_plan_badge = (string) ($caaft_plan['badge'] ?? '');
                            $caaft_plan_tier_label = '';
                        }
                        $caaft_plan_show_title = !empty($caaft_plan['show_card_title']) && !empty($caaft_plan['title']);
                        $caaft_plan_price_note = $caaft_plan['price_note'] ?? '+ GST';
                        ?>
                        <article class="<?php echo htmlspecialchars($caaft_plan_class, ENT_QUOTES, 'UTF-8'); ?> wow fadeInUp" data-wow-delay="<?php echo $caaft_plan_wow_delay; ?>s">
                            <?php if ($caaft_plan_badge !== '') : ?>
                                <span class="home3-plan-badge"><?php echo htmlspecialchars($caaft_plan_badge, ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php endif; ?>
                            <span class="home3-plan-watermark" aria-hidden="true"></span>
                            <?php if (!empty($caaft_plan_tier_label)) : ?>
                                <p class="home3-plan-tier"><?php echo htmlspecialchars($caaft_plan_tier_label, ENT_QUOTES, 'UTF-8'); ?></p>
                            <?php endif; ?>
                            <?php if ($caaft_plan_show_title) : ?>
                                <p class="home3-plan-name"><?php echo htmlspecialchars((string) $caaft_plan['title'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <?php endif; ?>
                            <div class="home3-plan-price">
                                <span class="home3-plan-amount"><span class="home3-plan-rupee" aria-hidden="true">&#8377;</span><?php echo htmlspecialchars((string) $caaft_plan['price'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <span class="home3-plan-price-suffix"><?php echo $caaft_plan_price_note; ?></span>
                            </div>
                            <a href="<?php echo htmlspecialchars($caaft_plan_href, ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars($caaft_plan_cta_class, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($caaft_plan_cta, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_plan_cta_icon, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                            </a>
                            <?php if (!empty($caaft_plan['features']) && is_array($caaft_plan['features'])) : ?>
                                <ul class="home3-plan-features">
                                    <?php foreach ($caaft_plan['features'] as $caaft_plan_feature) : ?>
                                        <?php
                                        if (is_array($caaft_plan_feature)) {
                                            $caaft_feature_text = (string) ($caaft_plan_feature['text'] ?? '');
                                            $caaft_feature_included = !isset($caaft_plan_feature['included']) || $caaft_plan_feature['included'];
                                        } else {
                                            $caaft_feature_text = (string) $caaft_plan_feature;
                                            $caaft_feature_included = true;
                                        }
                                        if ($caaft_feature_text === '') {
                                            continue;
                                        }
                                        $caaft_feature_li_class = $caaft_feature_included ? '' : ' is-muted';
                                        $caaft_feature_icon_class = $caaft_feature_included ? 'home3-plan-feature-icon home3-plan-feature-icon--yes' : 'home3-plan-feature-icon home3-plan-feature-icon--no';
                                        $caaft_feature_fa = $caaft_feature_included ? 'fas fa-check' : 'fas fa-times';
                                        ?>
                                        <li class="<?php echo trim($caaft_feature_li_class); ?>">
                                            <span class="<?php echo htmlspecialchars($caaft_feature_icon_class, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"><i class="<?php echo htmlspecialchars($caaft_feature_fa, ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                                            <span><?php echo htmlspecialchars($caaft_feature_text, ENT_QUOTES, 'UTF-8'); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </article>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($caaft_pricing_footnote)) : ?>
            <p class="text-center home3-plan-footnote"><?php echo $caaft_pricing_footnote; ?></p>
        <?php endif; ?>
    </div>
</section>
