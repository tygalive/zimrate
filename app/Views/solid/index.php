<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <?= view('solid/partials/head'); ?>

    <meta name="description" content="<?= lang('Site.default.description'); ?>" />
    <meta name="keywords" content="Zimbabwe, Rate, Bond, Rtgs, Zwl, Currency, Exchange, MarketWatch, Rbz">
    <meta name="author" content="Richard Muvirimi">

    <meta property="og:title" content="<?= lang('Site.default.title'); ?>">
    <meta property="og:description" content="<?= lang('Site.default.description'); ?>">

    <title><?= lang('Site.default.title'); ?></title>

    <script src="public/js/luxon.min.js"></script>
    <script src="public/js/date.js"></script>

</head>

<body class="is-boxed has-animations" onload="setDate()">
    <div class="body-wrap">

        <?= view("solid/partials/header") ?>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
                        <div class="hero-copy">
                            <h1 class="hero-title mt-0"><?= lang('Site.default.title'); ?></h1>
                            <p class="hero-paragraph"><?= lang('Site.default.description'); ?></p>
                            <div class="hero-cta"><a class="button button-primary" href="#rates"><?= lang('Site.page.home.rates'); ?></a><a class="button" href="developers"><?= lang('Site.page.home.developers'); ?></a></div>
                        </div>
                        <?= view("solid/partials/animation") ?>
                    </div>
                </div>
            </section>

            <section class="features section">
                <div class="container">
                    <div class="features-inner section-inner has-bottom-divider">

                        <div class="text-center">
                            <h2 class="section-title mt-0">
                                <?= lang('Site.page.home.title_why'); ?>
                            </h2>
                        </div>

                        <div class="features-wrap">
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="public/images/feature-icon-01.svg" alt="Feature 01">
                                    </div>
                                    <h4 class="feature-title mt-24">
                                        <?= lang('Site.page.home.benefit_productive_title'); ?></h4>
                                    <p class="text-sm mb-0"><?= lang('Site.page.home.benefit_productive'); ?></p>
                                </div>
                            </div>
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="public/images/feature-icon-02.svg" alt="Feature 02">
                                    </div>
                                    <h4 class="feature-title mt-24">
                                        <?= lang('Site.page.home.benefit_time_title'); ?></h4>
                                    <p class="text-sm mb-0"><?= lang('Site.page.home.benefit_time'); ?></p>
                                </div>
                            </div>
                            <div class="feature text-center is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
                                        <img src="public/images/feature-icon-03.svg" alt="Feature 03">
                                    </div>
                                    <h4 class="feature-title mt-24">
                                        <?= lang('Site.page.home.benefit_free_title'); ?></h4>
                                    <p class="text-sm mb-0"><?= lang('Site.page.home.benefit_free'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pricing section" id="rates">
                <div class="container-sm">
                    <div class="pricing-inner section-inner">
                        <div class="pricing-header text-center">
                            <p class="section-paragraph mb-0"><?= lang('Site.page.home.last_checked'); ?></p>
                            <h2 id="last_checked_date" class="section-title mt-0" data-checked="<?php echo $last_checked; ?>">...</h2>
                        </div>

                        <div class="section-paragraph mb-0">
                            <?= file_get_contents(FCPATH .  "public" . DIRECTORY_SEPARATOR . 'misc' . DIRECTORY_SEPARATOR . "notice.txt"); ?>
                        </div>

                        <div class="pricing-tables-wrap">

                            <?php foreach ($currencies as $key => $currency) : ?>

                                <div class="pricing-table">
                                    <div class="pricing-table-inner is-revealing" style="height: initial;">
                                        <div class="pricing-table-main">

                                            <div class="pricing-table-header pb-24">
                                                <div class="pricing-table-price">
                                                    <span class="pricing-table-price-amount h1">
                                                        <?php echo round($currency->max, 2); ?>
                                                    </span>
                                                    <span class="pricing-table-price-currency h2">
                                                        %
                                                    </span>
                                                    <span class="text-xs">
                                                        <?= lang('Site.page.home.maximum'); ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="pricing-table-header pb-24">
                                                <div class="pricing-table-price">
                                                    <span class="pricing-table-price-amount h1">
                                                        <?php echo round($currency->mean, 2); ?>
                                                    </span>
                                                    <span class="pricing-table-price-currency h2">
                                                        %
                                                    </span>
                                                    <span class="text-xs">
                                                        <?= lang('Site.page.home.average'); ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="pricing-table-header pb-24">
                                                <div class="pricing-table-price">
                                                    <span class="pricing-table-price-amount h1">
                                                        <?php echo round($currency->min, 2); ?>
                                                    </span>
                                                    <span class="pricing-table-price-currency h2">
                                                        %
                                                    </span>
                                                    <span class="text-xs">
                                                        <?= lang('Site.page.home.minimum'); ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="pricing-table-features-title text-xs pt-24 pb-24">
                                                <?= lang('Site.page.home.usd_rate', [$currency->currency]); ?>
                                            </div>

                                            <?php
                                            $rateModel = new \App\Models\RateModel();
                                            $sources = $rateModel->getCurrencySources($currency->currency); ?>

                                            <ul class="pricing-table-features list-reset text-xs">
                                                <?php foreach ($sources as $key => $source) : ?>
                                                    <li>
                                                        <span><?= auto_link(prep_url(parse_url($source->url, PHP_URL_HOST), strtolower(parse_url($source->url, PHP_URL_SCHEME)) == "https")); ?></span>
                                                    </li>
                                                <?php endforeach;
                                                ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>

                        <div class="pricing-header">
                            <p class="section-paragraph mb-0 text-center"><?= lang('Site.page.home.rate_usd'); ?>
                            </p>
                        </div>

                        <div class="pricing-header text-center">
                            <p class="section-paragraph mb-16"><?= lang('Site.page.home.sample_app'); ?></p>
                            <div class="cta-cta">
                                <a class="button button-primary button-wide-mobile mb-8" href='https://play.google.com/store/apps/details?id=com.tyganeutronics.myratecalculator&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1' target="_blank">
                                    <?= lang('Site.page.home.google_play'); ?>
                                </a>
                                <a class="button button-primary button-wide-mobile mb-8" href='https://wordpress.org/plugins/zimrate' target="_blank">
                                    <?= lang('Site.page.home.wordpress'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    </section>

    <section class="cta section">
        <div class="container">
            <div class="cta-inner section-inner">
                <h3 class="section-title mt-0"><?= lang('Site.page.home.not_convinced'); ?></h3>
                <div class="cta-cta">
                    <a class="button button-primary button-wide-mobile" href="https://tyganeutronics.com"><?= lang('Site.page.home.contact_btn'); ?></a>
                </div>
            </div>
        </div>
    </section>
    </main>

    <?= view('solid/partials/footer'); ?>

    </div>

    <script src="public/js/main.min.js"></script>
</body>

</html>