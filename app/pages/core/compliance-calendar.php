<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="all, index, follow" >
      <title>Compliance Calendar 2025 | GST, IT, PF/ESI Deadlines</title>
      <meta name="Description" content="Download the Compliance Calendar 2025 with important due dates for GST, Income Tax, PF/ESI, and FEMA. Stay updated with monthly regulatory deadlines." >
      <link rel="canonical" href="https://caaft.com/compliance-calendar" >
      <meta property="og:locale" content="en_US">
      <meta property="og:type" content="article" >
      <meta property="og:title" content="Compliance Calendar 2025 | GST, IT, PF/ESI Deadlines" >
      <meta property="og:description" content="Download the Compliance Calendar 2025 with important due dates for GST, Income Tax, PF/ESI, and FEMA. Stay updated with monthly regulatory deadlines." >
      <meta property="og:url" content="https://caaft.com/compliance-calendar" >
      <meta property="og:site_name" content="CAAFT Consultancy Services" >
      <meta property="og:image" content="https://caaft.com/assets/img/general-accounting-services.webp" >
      <!--<meta property="fb:app_id" content="kpwebtechcom" >-->
      <meta name="twitter:card" content="summary_large_image" >
      <meta name="twitter:title" content="Compliance Calendar 2025 | GST, IT, PF/ESI Deadlines" >
      <meta name="twitter:creator" content="@CaaftServices">
      <meta name="twitter:site" content="@CaaftServices">
      <meta name="twitter:image" content="https://caaft.com/assets/img/general-accounting-services.webp">
    <?php include "header-top.php"; ?>
    <?php include dirname(__DIR__, 2) . '/includes/components/caaft-schema-organization.php'; ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "@id": "https://caaft.com/compliance-calendar/#webpage",
      "url": "https://caaft.com/compliance-calendar",
      "name": "Compliance Calendar 2025 | GST, IT, PF/ESI Deadlines",
      "description": "Download the Compliance Calendar 2025 with important due dates for GST, Income Tax, PF/ESI, and FEMA. Stay updated with monthly regulatory deadlines.",
      "isPartOf": {"@id": "https://caaft.com/#organization"},
      "publisher": {"@id": "https://caaft.com/#organization"}
    }
    </script>

</head>
<body class="home-3">
<?php include dirname(__DIR__, 2) . '/includes/gtm-noscript.php'; ?>
<!--<div class="preloader">
        <div class="loader-ripple">
            <div>
                <a>
                    <img src="assets/img/caaft-logo-header.webp" alt="caaft" title="caaft" class="img-fluid">
                </a>
            </div>
        </div>
    </div>-->
    <div class="header-sections">
        <?php include "header.php"; ?>
    </div>
    <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="#">
            <div class="form-group">
                <input type="search" name="search-field" class="form-control" placeholder="Search Here..." required>
                <button type="submit"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>
    <main class="main">
        <div class="site-breadcrumb" style="background: url(assets/img/caaft/calendar-banner.webp)">
            <div class="container">
                <h1 class="breadcrumb-title">Compliance Calendar</h1>
            </div>
        </div>

         <!--start-->
         <?php
         $compliance_calendar_months = [
             'January', 'February', 'March', 'April', 'May', 'June',
             'July', 'August', 'September', 'October', 'November', 'December',
         ];

         $compliance_calendar_pdfs = [
             2026 => [
                 'January' => 'assets/img/pdf/monthly-compliance-calendar-jan26.pdf',
                 'February' => 'assets/img/pdf/monthly-compliance-calendar-feb26.pdf',
                 'March' => 'assets/img/pdf/monthly-compliance-calendar-march26.pdf',
                 'April' => 'assets/img/pdf/monthly-compliance-calendar-april26.pdf',
                 'May' => 'assets/img/pdf/monthly-compliance-calendar-may26.pdf',
                 'June' => 'assets/img/pdf/monthly-compliance-calendar-june26.pdf',
             ],
             2025 => [
                 'May' => 'assets/img/pdf/monthly-compliance-calendar-may-25.pdf',
                 'June' => 'assets/img/pdf/monthly-compliance-calendar-june-25.pdf',
                 'July' => 'assets/img/pdf/monthly-compliance-calendar-july-25.pdf',
                 'August' => 'assets/img/pdf/monthly-compliance-calendar-august-25.pdf',
                 'September' => 'assets/img/pdf/monthly-compliance-calendar-september-25.pdf',
                 'October' => 'assets/img/pdf/monthly-compliance-calendar-october-25.pdf',
                 'November' => 'assets/img/pdf/monthly-compliance-calendar-november-25.pdf',
                 'December' => 'assets/img/pdf/monthly-compliance-calendar-december-25.pdf',
             ],
         ];

         $compliance_calendar_years = array_keys($compliance_calendar_pdfs);
         rsort($compliance_calendar_years, SORT_NUMERIC);
         ?>
         <section class="calendar-new">
         <div class="cal-caft container">
  <h2 class="head-com">Compliance Calendar</h2>
  <div class="accordion compliance-year-accordion" id="complianceCalendarAccordion">
    <?php $year_index = 0; foreach ($compliance_calendar_years as $year) : ?>
    <?php
        $year_index++;
        $is_first_year = $year_index === 1;
        $heading_id = 'complianceYear' . $year . 'Heading';
        $collapse_id = 'complianceYear' . $year . 'Collapse';
        $year_pdfs = $compliance_calendar_pdfs[$year] ?? [];
    ?>
    <div class="accordion-item">
      <h3 class="accordion-header" id="<?php echo htmlspecialchars($heading_id, ENT_QUOTES, 'UTF-8'); ?>">
        <button class="accordion-button<?php echo $is_first_year ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo htmlspecialchars($collapse_id, ENT_QUOTES, 'UTF-8'); ?>" aria-expanded="<?php echo $is_first_year ? 'true' : 'false'; ?>" aria-controls="<?php echo htmlspecialchars($collapse_id, ENT_QUOTES, 'UTF-8'); ?>">
          <?php echo (int) $year; ?>
        </button>
      </h3>
      <div id="<?php echo htmlspecialchars($collapse_id, ENT_QUOTES, 'UTF-8'); ?>" class="accordion-collapse collapse<?php echo $is_first_year ? ' show' : ''; ?>" aria-labelledby="<?php echo htmlspecialchars($heading_id, ENT_QUOTES, 'UTF-8'); ?>" data-bs-parent="#complianceCalendarAccordion">
        <div class="accordion-body">
          <div class="compliance-month-grid" role="list">
            <?php foreach ($compliance_calendar_months as $month_name) : ?>
            <?php
                $pdf = $year_pdfs[$month_name] ?? null;
                $tile_label = $month_name . ' ' . $year;
            ?>
            <?php if ($pdf) : ?>
            <a href="<?php echo htmlspecialchars($pdf, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="compliance-month-tile" role="listitem" title="<?php echo htmlspecialchars($tile_label . ' compliance calendar (PDF)', ENT_QUOTES, 'UTF-8'); ?>">
              <span class="compliance-month-tile__name"><?php echo htmlspecialchars($month_name, ENT_QUOTES, 'UTF-8'); ?></span>
              <span class="compliance-month-tile__year"><?php echo (int) $year; ?></span>
            </a>
            <?php else : ?>
            <span class="compliance-month-tile compliance-month-tile--unavailable" role="listitem" aria-disabled="true" title="<?php echo htmlspecialchars($tile_label . ' calendar not available yet', ENT_QUOTES, 'UTF-8'); ?>">
              <span class="compliance-month-tile__name"><?php echo htmlspecialchars($month_name, ENT_QUOTES, 'UTF-8'); ?></span>
              <span class="compliance-month-tile__year"><?php echo (int) $year; ?></span>
            </span>
            <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>


         </section>
         

    </main>

     <?php include "footer.php";?>
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>


    <?php include "footer-bottom.php"; ?>

</body>

</html>
