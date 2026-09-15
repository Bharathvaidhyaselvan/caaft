<?php
/**
 * Careers apply form for the service-style hero (.quote-content).
 *
 * Required before include:
 *   $job (array) — job data from caaft-careers.php
 */
declare(strict_types=1);

if (!isset($job) || !is_array($job)) {
    trigger_error('careers-apply-form.php: set $job before including', E_USER_WARNING);
    return;
}

$jobTitle = (string) ($job['title'] ?? 'Open Position');
$jobSlug = (string) ($job['slug'] ?? '');
?>
<div class="quote-content caaft-careers-quote" id="quote-content">
    <div class="quote-head">
        <h3>Apply for this Job</h3>
        <p>Share your details and resume. Our HR team will get back to you.</p>
    </div>
    <div class="quote-form">
        <form method="post" action="/careers-apply.php" class="contact caaft-careers-apply-form" id="careers-form" enctype="multipart/form-data" data-caaft-ajax-submit="1" novalidate>
            <?php include __DIR__ . '/caaft-form-page-url-field.php'; ?>
            <input type="hidden" name="job_slug" value="<?php echo htmlspecialchars($jobSlug, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="job_title" value="<?php echo htmlspecialchars($jobTitle, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input name="firstname" type="text" class="hide-robot" style="display:none;" tabindex="-1" autocomplete="off" aria-hidden="true">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-user" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required autocomplete="given-name">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-user-tie" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required autocomplete="family-name">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-envelope" aria-hidden="true"></i></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required autocomplete="email">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-phone" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="phone" id="phone" maxlength="10" placeholder="Mobile Number" required autocomplete="tel" inputmode="numeric">
                    </div>
                    <input type="text" name="website" class="hide-robot" style="display:none;" tabindex="-1" autocomplete="off" aria-hidden="true">
                </div>
                <div class="col-lg-12">
                    <div class="caaft-careers-resume">
                        <label class="caaft-careers-resume-btn" for="resume" tabindex="0">
                            <i class="far fa-paperclip" aria-hidden="true"></i> Attach Your Resume
                        </label>
                        <input type="file" name="resume" id="resume" class="caaft-careers-resume-input" accept=".doc,.docx,.pdf,.rtf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/rtf,text/rtf">
                        <span class="caaft-careers-resume-name" id="resume-file-name">No File Chosen (optional)</span>
                    </div>
                    <span class="caaft-careers-resume-hint">Optional. Supported formats: .doc, .docx, .pdf, .rtf. Max file size: 5 MB.</span>
                </div>
                <div class="col-lg-12">
                    <div class="form-check caaft-careers-terms">
                        <input class="form-check-input" type="checkbox" value="1" id="agree_terms" name="agree_terms" required>
                        <label class="form-check-label" for="agree_terms">
                            I agree with the <a href="/terms-and-conditions" target="_blank" rel="noopener">terms and conditions</a> and <a href="/privacy-policy" target="_blank" rel="noopener">privacy policy</a>.
                        </label>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="g-recaptcha" data-sitekey="6LcO3ukrAAAAADerciVZtVVgPZqbR-iH04HfKq-K"></div>
                </div>
                <div class="col-lg-12">
                    <div class="caaft-careers-success" id="careers-success" hidden role="status" aria-live="polite">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        <p>Thank you for your interest in joining our team! Our HR team will review your application and contact you if your profile matches our requirement.</p>
                    </div>
                    <button type="submit" class="theme-btn automated_mail">Apply Now <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
(function () {
    var form = document.getElementById('careers-form');
    var success = document.getElementById('careers-success');
    var input = document.getElementById('resume');
    var label = document.getElementById('resume-file-name');
    var submitBtn = form ? form.querySelector('button[type="submit"]') : null;
    var submitBtnHtml = submitBtn ? submitBtn.innerHTML : '';
    var thankYouUrl = '/thankyou.php';
    var thankYouDelay = 2000;

    if (input && label) {
        input.addEventListener('change', function () {
            label.textContent = input.files && input.files[0] ? input.files[0].name : 'No File Chosen (optional)';
        });
    }

    if (!form || !success) {
        return;
    }

    function showSuccess() {
        success.hidden = false;
        success.classList.add('is-visible');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('is-submitted');
            submitBtn.innerHTML = 'Submitted';
        }
        success.scrollIntoView({ behavior: 'smooth', block: 'center' });
        setTimeout(function () {
            window.location.href = thankYouUrl;
        }, thankYouDelay);
    }

    function resetBusy() {
        form.dataset.busy = '0';
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('is-submitted');
            submitBtn.innerHTML = submitBtnHtml;
        }
        if (window.grecaptcha && typeof window.grecaptcha.reset === 'function') {
            try { window.grecaptcha.reset(); } catch (e) {}
        }
    }

    function friendlyError(text, status) {
        var raw = (text || '').toString();
        if (status === 403 || /403\s*Forbidden|Access to this resource on the server is denied/i.test(raw)) {
            return 'Upload was blocked by the server firewall. Please rename your resume to a simple name (letters/numbers only, e.g. resume.pdf) and try again.';
        }
        if (status === 413 || /request entity too large/i.test(raw)) {
            return 'Resume file is too large. Please upload a file under 5 MB.';
        }
        if (/<html[\s>]/i.test(raw) || /<!DOCTYPE/i.test(raw)) {
            return 'There was an error sending your application. Please try again later.';
        }
        var trimmed = raw.replace(/\s+/g, ' ').trim();
        if (trimmed.length > 220) {
            return 'There was an error sending your application. Please try again later.';
        }
        return trimmed || 'There was an error sending your application. Please try again later.';
    }

    function buildSafeFormData(sourceForm) {
        var data = new FormData(sourceForm);
        var fileInput = sourceForm.querySelector('input[type="file"][name="resume"]');
        if (fileInput && fileInput.files && fileInput.files[0]) {
            var file = fileInput.files[0];
            var ext = (file.name.split('.').pop() || 'pdf').toLowerCase().replace(/[^a-z0-9]/g, '') || 'pdf';
            var safeName = 'resume-' + Date.now() + '.' + ext;
            data.set('resume', file, safeName);
        }
        return data;
    }

    form.addEventListener('caaft:ajax-submit', function () {
        if (form.dataset.busy === '1') {
            return;
        }
        form.dataset.busy = '1';
        if (submitBtn) {
            submitBtn.disabled = true;
        }

        fetch(form.getAttribute('action') || '/careers-apply.php', {
            method: 'POST',
            body: buildSafeFormData(form),
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        }).then(function (res) {
            var type = res.headers.get('content-type') || '';
            if (type.indexOf('application/json') !== -1) {
                return res.json().then(function (json) {
                    if (!json || !json.ok) {
                        throw new Error((json && json.message) || 'There was an error sending your application. Please try again later.');
                    }
                });
            }
            return res.text().then(function (text) {
                if (!res.ok) {
                    throw new Error(friendlyError(text, res.status));
                }
                // Non-JSON success (legacy redirect/script) — treat as ok if not an error page.
                if (/403\s*Forbidden|Access to this resource on the server is denied/i.test(text || '')) {
                    throw new Error(friendlyError(text, 403));
                }
            });
        }).then(showSuccess).catch(function (err) {
            resetBusy();
            alert(err && err.message ? err.message : 'There was an error sending your application. Please try again later.');
        });
    });
})();
</script>
