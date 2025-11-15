# Contact Form 7 Issues Documentation

**Date:** November 15, 2024  
**Status:** 🔴 CRITICAL - Form not rendering/functioning

## Issues Identified

### 1. Template Bug (CRITICAL)

**File:** `wp-content/themes/MariasPlace/template-parts/content-page.php`  
**Lines:** 23-24  
**Problem:** Incorrect handling of content output prevents shortcodes from processing

**Broken Code:**
```php
$content = the_content();
do_shortcode($content);
```

**Why This Breaks Contact Form 7:**
1. `the_content()` **outputs** content directly and returns `null` (not the content string)
2. Assigning it to `$content` stores nothing (`null`)
3. `do_shortcode($content)` processes nothing and doesn't output anything
4. Contact Form 7 shortcodes `[contact-form-7 id="..."]` never get processed

**Fixed Code:**
```php
// the_content() automatically processes shortcodes and outputs content
the_content();
```

WordPress's `the_content()` filter automatically processes all shortcodes including Contact Form 7, so no additional processing is needed.

### 2. Content Security Policy Restrictions

**File:** `.htaccess`  
**Line:** 114  
**Issue:** CSP header may interfere with Contact Form 7 AJAX functionality

**Current CSP:**
```apache
Header set Content-Security-Policy "default-src 'self' https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https: data:; script-src-elem 'self' 'unsafe-inline' https: data:; worker-src 'self' blob:; style-src 'self' 'unsafe-inline' https:; img-src 'self' data: https:; font-src 'self' data: https:; connect-src 'self' https: wss:; frame-src 'self' https:; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests"
```

**Potential Issues:**
- `form-action 'self'` - Restricts form submissions (may block AJAX endpoints)
- Contact Form 7 uses AJAX for form submissions
- CSP may block inline scripts needed for form validation

**Current Status:** 
- CSP does allow `'unsafe-inline'` and `'unsafe-eval'` for scripts (good)
- CSP allows `https:` for `connect-src` (should allow AJAX to same domain)

**Action Required:**
1. Fix the template bug (primary issue) ✅ FIXED
2. Test form functionality
3. If still broken, may need to adjust CSP or test with CSP temporarily disabled

## Expected Behavior

After fix:
- Contact Form 7 shortcode `[contact-form-7 id="..."]` should render the form
- Form should display all fields configured in WordPress admin
- Form should submit via AJAX
- Success/error messages should appear

## Current Page Display

**URL:** https://mariasplace.com/contact/  
**Current Content:** Shows `**[email protected]**` (plain text) instead of form  
**Expected:** Should show Contact Form 7 form

## Testing Steps

1. **Verify Template Fix:**
   ```bash
   # Upload fixed template-parts/content-page.php to server
   ```

2. **Check WordPress Admin:**
   - Go to WordPress admin → Contact → Contact Forms
   - Verify form exists and is published
   - Copy the shortcode (e.g., `[contact-form-7 id="123"]`)
   - Verify the contact page uses this shortcode

3. **Test on Live Site:**
   - Visit https://mariasplace.com/contact/
   - Form should now appear
   - Try submitting a test message

4. **Check Browser Console:**
   - Open browser DevTools (F12)
   - Check Console for CSP violations
   - Look for JavaScript errors related to Contact Form 7

5. **If Form Still Doesn't Work:**
   - Check if Contact Form 7 plugin is active
   - Check if plugin files exist on server
   - Check for JavaScript errors
   - Test with CSP temporarily disabled

## Related Files

- **Template:** `wp-content/themes/MariasPlace/template-parts/content-page.php`
- **Theme Functions:** `wp-content/themes/MariasPlace/functions.php` (line 1546 - CF7 filter)
- **JavaScript:** `wp-content/themes/MariasPlace/inc/assets/js/theme-script.js` (CF7 styling)
- **CSS:** `wp-content/themes/MariasPlace/inc/assets/css/custom-style.css` (CF7 styles)
- **Configuration:** `.htaccess` (CSP headers)

## Contact Form 7 Plugin Status

From theme files, Contact Form 7 is:
- ✅ Referenced in theme CSS (`.wpcf7-*` classes)
- ✅ Referenced in theme JavaScript (form styling)
- ✅ Has custom filter in functions.php (`wpcf7_validate_text*`)

**Unknown:**
- ❓ Is plugin installed and active on live site?
- ❓ Are plugin files present in `/wp-content/plugins/contact-form-7/`?
- ❓ Is there a form configured in WordPress admin?

## Next Steps

1. ✅ **Fix template bug** - DONE
2. ⏳ Upload fixed template to live server
3. ⏳ Verify Contact Form 7 plugin is installed and active
4. ⏳ Test form on live site
5. ⏳ If issues persist, check browser console for errors
6. ⏳ Consider temporarily disabling CSP headers to test

## Notes

- The template bug is the most likely culprit
- WordPress's `the_content()` function automatically processes all shortcodes
- No need for manual `do_shortcode()` calls when using `the_content()`
- Contact Form 7 relies heavily on JavaScript for AJAX submissions
- CSP restrictions could still cause issues even if template is fixed


