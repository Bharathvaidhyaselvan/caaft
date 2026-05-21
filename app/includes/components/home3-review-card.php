<?php
/**
 * Single homepage testimonial card (used inside home3-reviews-slider).
 *
 * Expects $home3_review with: initial, avatar (a–g), name, role, quote
 */
if (!isset($home3_review) || !is_array($home3_review)) {
    return;
}
$home3_review_initial = htmlspecialchars((string) ($home3_review['initial'] ?? ''), ENT_QUOTES, 'UTF-8');
$home3_review_avatar = preg_replace('/[^a-g]/', '', (string) ($home3_review['avatar'] ?? 'a'));
$home3_review_name = htmlspecialchars((string) ($home3_review['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$home3_review_role = htmlspecialchars((string) ($home3_review['role'] ?? ''), ENT_QUOTES, 'UTF-8');
$home3_review_quote = htmlspecialchars((string) ($home3_review['quote'] ?? ''), ENT_QUOTES, 'UTF-8');
?>
<article class="home3-review-card">
    <header class="home3-review-card__head">
        <div class="home3-review-card__intro">
            <div class="home3-review-avatar home3-review-avatar--<?php echo $home3_review_avatar; ?>" aria-hidden="true"><?php echo $home3_review_initial; ?></div>
            <div class="home3-review-card__identity">
                <p class="home3-review-name"><?php echo $home3_review_name; ?></p>
                <div class="home3-review-stars" aria-label="5 out of 5 stars">
                    <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i>
                </div>
                <p class="home3-review-role"><?php echo $home3_review_role; ?></p>
            </div>
        </div>
        <div class="home3-review-google" title="Google review" aria-label="Google review">
            <svg class="home3-review-google__mark" viewBox="0 0 24 24" width="26" height="26" aria-hidden="true" focusable="false"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
        </div>
    </header>
    <p class="home3-review-quote"><?php echo $home3_review_quote; ?></p>
</article>
