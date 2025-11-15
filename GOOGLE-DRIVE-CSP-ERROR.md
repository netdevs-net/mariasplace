# Google Drive CSP Error Explanation

**Date:** November 15, 2024  
**Error:** `Framing 'https://drive.google.com/' violates the following Content Security Policy directive: "frame-ancestors https://drive.google.com"`

## Understanding the Error

This error is **NOT from your site's CSP** - it's from **Google Drive's own security policy**.

### What's Happening:

1. **Your site** embeds Google Drive PDFs in iframes (line 58 of `content.php`)
2. **Google Drive** has a CSP header called `frame-ancestors` that prevents its content from being embedded on external sites
3. **Google Drive blocks the embedding** for security reasons (clickjacking protection)

### The Error Message Breakdown:

```
Framing 'https://drive.google.com/' violates the following 
Content Security Policy directive: "frame-ancestors https://drive.google.com"
```

- **"Framing"** = Trying to embed in an iframe
- **"frame-ancestors"** = Google Drive's CSP directive that controls where it can be embedded
- **"https://drive.google.com"** = Google Drive only allows embedding on its own domain

## Why Google Drive Blocks Embedding

Google Drive uses `frame-ancestors` CSP header to:
1. **Prevent clickjacking attacks** - Malicious sites embedding Drive content
2. **Protect user data** - Prevent unauthorized access to Drive content
3. **Control sharing** - Users must explicitly enable embedding in sharing settings

## Solutions Applied

### 1. Updated CSP Header (`.htaccess`)

**Before:**
```apache
frame-src 'self' https:
```

**After:**
```apache
frame-src 'self' https: https://drive.google.com https://*.googleusercontent.com
```

This explicitly allows Google Drive domains in your site's CSP.

### 2. Fixed PDF URL Format (`content.php`)

**Before:**
```php
$pdf_Iframe = '<iframe src="' . get_field('pdf_url') . '?usp=drivesdk"></iframe>';
```

**After:**
```php
// Converts Google Drive URLs to proper embeddable format
// Uses /preview endpoint which is designed for embedding
$pdf_url = 'https://drive.google.com/file/d/FILE_ID/preview';
```

## Additional Requirements

For Google Drive PDFs to embed successfully, you need:

1. **Sharing Settings:**
   - PDF must be shared as "Anyone with the link can view"
   - In Google Drive, right-click PDF → Share → Change to "Anyone with the link"

2. **Proper URL Format:**
   - Use: `https://drive.google.com/file/d/FILE_ID/preview`
   - NOT: `https://drive.google.com/file/d/FILE_ID/view?usp=sharing`
   - NOT: `https://drive.google.com/file/d/FILE_ID/edit`

3. **File Permissions:**
   - PDF must be publicly viewable
   - Owner must allow embedding

## Alternative Solutions

If Google Drive embedding continues to fail:

### Option 1: Host PDFs Locally
- Download PDFs from Google Drive
- Upload to WordPress media library
- Embed using WordPress's built-in PDF viewer

### Option 2: Use Google Drive Embed API
- Requires API key setup
- More complex but more reliable

### Option 3: Use PDF.js Viewer
- Self-hosted PDF viewer
- No external dependencies
- Full control over embedding

### Option 4: Direct Download Links
- Remove iframe embedding
- Use direct download links instead
- Users download and view PDFs locally

## Testing

After changes:
1. Clear all caches (LiteSpeed + browser)
2. Test on: https://mariasplace.com/coloring-christmas-baubles/
3. Check browser console for CSP errors
4. Verify PDF displays in iframe

## Current Status

✅ **CSP Updated** - Now explicitly allows Google Drive domains  
✅ **URL Format Fixed** - Converts to proper embeddable format  
⏳ **Testing Required** - Need to verify PDFs are shared correctly in Google Drive

## Notes

- The error is a **warning**, not necessarily a blocker
- PDFs may still display even with the error
- The error appears in console but may not prevent functionality
- Google Drive's `frame-ancestors` policy is strict and cannot be bypassed


