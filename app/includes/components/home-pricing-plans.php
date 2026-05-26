<?php
/**
 * Homepage pricing plans — Pvt Ltd, LLP, OPC incorporation packages.
 */
$caaft_bsr_pricing_data = require dirname(__DIR__) . '/data/caaft-business-setup-pricing.php';
$caaft_pricing_plans = $caaft_bsr_pricing_data['home_plans'];
$caaft_pricing_section_id = 'pricing-plans';
$caaft_pricing_heading_id = 'home-pricing-plans-heading';
$caaft_pricing_title = 'Let&rsquo;s Check Our <span>Pricing</span> Plan For You';
include __DIR__ . '/caaft-pricing-plans.php';
