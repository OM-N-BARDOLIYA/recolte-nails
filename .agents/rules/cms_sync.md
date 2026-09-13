# CMS and Web Storefront Synchronization Rule

Whenever a change is requested for any section, page, content, layout, or design on the storefront website:
1. **Synchronize CMS & Web**: Always implement the changes in the Admin CMS (views, controllers, form inputs, validation, image uploads, preview states) as well as the web storefront.
2. **Database Persistence**: Ensure all default values, fallbacks, and CMS database records (`PageContent`, `SiteSetting`, etc.) accurately reflect the new live website content.
3. **Admin UI Capabilities**: Ensure the CMS admin panel gives the administrator full ability to inspect, edit, preview, and update all live sections and slides.
