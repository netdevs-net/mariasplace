# CSP and Functions.php Bugs - Contact Form 7 Issues

**Date:** November 15, 2024  
**Status:** 🔴 CRITICAL - Multiple issues affecting Contact Form 7

## Issue 1: Functions.php Bug - Undefined Variable

**File:** `wp-content/themes/MariasPlace/functions.php`  
**Lines:** 1531-1543  
**Function:** `signup_btn()`  
**Severity:** ⚠️ PHP Warning/Error

**Bug Code:**
```php
function signup_btn( $atts ) {
	$btn = shortcode_atts( array(
		'logged-in-url' => '#',
		'logged-out-url' => '#',        
		'logged-in-label' => 'Sign Up',
		'logged-out-label' => 'Sign Up',        
        'class' => ''
	), $atts );
    $label = is_user_logged_in() ? $btn['logged-in-label'] : $btn['logged-out-label'];
    $url = is_user_logged_in() ? $btn['logged-in-url'] : $btn['logged-out-url'];
    $html .= "<a class='btn ".$btn['class']."' href='".$url."'>" . $label . "</a>";  // ❌ BUG: $html not initialized
	return $html;
}
```

**Problem:**
- Variable `$html` is used with `.=` concatenation operator but is never initialized
- In PHP 8.0+, this generates a warning: "Undefined variable $html"
- Can cause fatal errors in strict mode
- May break other shortcodes on the page

**Fix:**
```php
function signup_btn( $atts ) {
	$btn = shortcode_atts( array(
		'logged-in-url' => '#',
		'logged-out-url' => '#',        
		'logged-in-label' => 'Sign Up',
		'logged-out-label' => 'Sign Up',        
        'class' => ''
	), $atts );
    $label = is_user_logged_in() ? $btn['logged-in-label'] : $btn['logged-out-label'];
    $url = is_user_logged_in() ? $btn['logged-in-url'] : $btn['logged-out-url'];
    $html = "<a class='btn ".$btn['class']."' href='".$url."'>" . $label . "</a>";  // ✅ Initialize with =
	return $html;
}
```

## Issue 2: Content Security Policy - Potential AJAX Blocking

**File:** `.htaccess`  
**Line:** 114  
**Status:** ⚠️ May be blocking Contact Form 7 AJAX

**Current CSP:**
```apache
Header set Content-Security-Policy "default-src 'self' https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https: data:; script-src-elem 'self' 'unsafe-inline' https: data:; worker-src 'self' blob:; style-src 'self' 'unsafe-inline' https:; img-src 'self' data: https:; font-src 'self' data: https:; connect-src 'self' https: wss:; frame-src 'self' https:; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests"
```

### CSP Directives Analysis:

1. **`connect-src 'self' https: wss:`** ✅ Should allow AJAX to same domain
   - Contact Form 7 uses AJAX to submit forms
   - Endpoint: `/wp-admin/admin-ajax.php` (same domain)
   - Should work, but may need explicit `admin-ajax.php` path

2. **`form-action 'self'`** ✅ Should allow form submissions
   - Forms can submit to same domain
   - Contact Form 7 submits via AJAX (not direct form POST)
   - Should be fine

3. **`script-src 'self' 'unsafe-inline' 'unsafe-eval' https: data:`** ✅ Allows inline scripts
   - Contact Form 7 injects inline JavaScript for form validation
   - Should work with `'unsafe-inline'`

### Potential CSP Violations:

**Common CSP errors that would appear in browser console:**

1. **Refused to connect to '...' because it violates the following Content Security Policy directive: "connect-src ..."**
   - Would block Contact Form 7 AJAX submissions
   - **Solution:** Ensure `admin-ajax.php` is on same domain (it is)

2. **Refused to execute inline script because it violates the following Content Security Policy directive: "script-src ..."**
   - Would block Contact Form 7's inline validation scripts
   - **Current Status:** ✅ Allowed with `'unsafe-inline'`

3. **Refused to send form data because it violates the following Content Security Policy directive: "form-action ..."**
   - Would block form submissions
   - **Current Status:** ✅ Should allow `'self'`

## Issue 3: Conflicting CSP Headers

**File:** `.htaccess`  
**Lines:** 114 and 123

**Problem:** Two different CSP headers set:
- Line 114: Full CSP policy
- Line 123: `X-Content-Security-Policy` (legacy header)

**Current:**
```apache
Line 114: Header set Content-Security-Policy "..."
Line 123: Header set X-Content-Security-Policy "default-src 'self'; img-src *; media-src * data:;"
```

**Issue:**
- `X-Content-Security-Policy` is a legacy header (IE/Edge)
- Conflicting policies can cause unpredictable behavior
- The legacy header is less restrictive (allows `img-src *`)

**Impact:**
- Browsers may use either header
- Inconsistent behavior across browsers
- May allow resources that should be blocked
- May block resources that should be allowed

## Browser Console CSP Errors to Look For

When visiting https://mariasplace.com/contact/, check browser console (F12) for:

### 1. CSP Violation Reports:
```
Refused to execute inline script because it violates the following 
Content Security Policy directive: "script-src ..."
```

### 2. AJAX Blocking:
```
Refused to connect to 'https://mariasplace.com/wp-admin/admin-ajax.php' 
because it violates the following Content Security Policy directive: "connect-src ..."
```

### 3. Form Submission Blocking:
```
Refused to send form data because it violates the following 
Content Security Policy directive: "form-action ..."
```

### 4. Script Loading Errors:
```
Failed to load resource: net::ERR_BLOCKED_BY_CLIENT
```

## Testing Steps

### 1. Check Browser Console:
```javascript
// Open browser DevTools (F12)
// Go to Console tab
// Look for CSP violation errors
// Look for AJAX errors
// Look for 403/blocked requests
```

### 2. Check Network Tab:
```javascript
// Open DevTools → Network tab
// Submit Contact Form 7 form
// Look for failed requests to:
//   - /wp-admin/admin-ajax.php
//   - Check response status (should be 200, not 403/blocked)
```

### 3. Test CSP in Report-Only Mode:
```apache
# Temporarily change to report-only mode to see violations
Header set Content-Security-Policy-Report-Only "..."
```

## Recommended Fixes

### Fix 1: Functions.php Bug ✅
```php
// Initialize $html variable
$html = "<a class='btn ".$btn['class']."' href='".$url."'>" . $label . "</a>";
```

### Fix 2: Test CSP Impact
1. Temporarily comment out CSP header
2. Test if Contact Form 7 works
3. If it works, CSP is the issue
4. Adjust CSP to allow necessary resources

### Fix 3: Remove Conflicting CSP Header
```apache
# Remove or update legacy X-Content-Security-Policy header
# Line 123 - Remove if not needed for IE support
```

### Fix 4: Add CSP Report-Only for Testing
```apache
# Add this temporarily to see CSP violations without blocking
Header set Content-Security-Policy-Report-Only "..." "default-src 'self' https:; ..."
```

## Additional CSP Concerns for Contact Form 7

Contact Form 7 requires:
1. ✅ Inline scripts (allowed with `'unsafe-inline'`)
2. ✅ AJAX requests to `admin-ajax.php` (allowed with `connect-src 'self'`)
3. ✅ Form submissions (allowed with `form-action 'self'`)
4. ✅ Inline styles for validation messages (allowed with `style-src 'unsafe-inline'`)

**Current CSP should work, but:**
- PHP errors from functions.php bug may prevent scripts from loading
- Conflicting CSP headers may cause issues
- Browser-specific CSP parsing differences

## Priority Fix Order

1. 🔴 **Fix functions.php bug** - May be causing fatal errors preventing page load
2. 🟡 **Fix template bug** - Already fixed in content-page.php
3. 🟡 **Test CSP impact** - Temporarily disable to see if it's the issue
4. 🟢 **Clean up CSP headers** - Remove conflicting legacy header

## Related Files

- `wp-content/themes/MariasPlace/functions.php` (line 1541 - bug)
- `.htaccess` (line 114 - CSP, line 123 - legacy CSP)
- `wp-content/themes/MariasPlace/template-parts/content-page.php` (already fixed)


