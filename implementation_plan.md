# Implementation Plan

## Goal Description
Restore the static layout structure for specific sections (like the FAQ) directly into the Blade templates, and remove the intrusive CSS that broke the Table of Contents and FAQ display. The WYSIWYG editor will be reserved strictly for the main textual content.

## User Review Required
> [!IMPORTANT]
> Since there is only one content field in your database for each policy, we cannot easily inject dynamic editor text into multiple different hardcoded boxes (like injecting some text into a Quick Overview box, and other text into a Fare Rules box). 
> 
> **My Proposal:**
> 1. I will hardcode the **FAQ Section** directly into the Blade templates (outside the editor) so you can manage it statically or separately.
> 2. I will revert the CSS that added black borders to h4 tags (which broke your FAQ look).
> 3. I will make sure the right sidebar **Table of Contents** looks exactly as you originally designed it.
> 
> **Open Question:** 
> For the **Quick Overview** cyan box: Do you want me to hardcode the cyan box directly into the Blade file as well? If I do this, the text inside the Quick Overview will be static for all airlines unless we add a new database column (like quick_overview_text). If you want to be able to edit the Quick Overview text in the WYSIWYG editor, we have to keep using the CSS approach for that specific box. Please let me know if you want the Quick Overview hardcoded outside the editor, or kept dynamic inside it!

## Proposed Changes
### public/css/style.css
- [MODIFY] Remove the h4 and h4+p border styling that was making the FAQs look like plain boxes.
- [MODIFY] Ensure .dynamic-policy-content rules do not leak into the right sidebar TOC.

### Blade Templates (esources/views/*/show.blade.php)
- [MODIFY] Re-add the static Bootstrap accordion for the **Frequently Asked Questions** section at the bottom of the main content column (outside of the {!! ['policy']->content !!} block).

## Verification Plan
- Refresh the browser and verify the FAQ is a proper Bootstrap accordion again.
- Verify the right sidebar TOC is restored to its original styling.
