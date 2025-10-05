# TODO: Remove API Usage and Use Simple PHP DB Connections

## Tasks to Complete

- [x] Modify src/menu.php to dynamically load menu items from database instead of static HTML
- [ ] Update src/dashboard_admin.php to include PHP code for loading stats, menus, orders, customers, inventory, promos directly from DB
- [ ] Modify logic/dashboard_admin.js to remove fetch() calls for loading data and change form submissions to use direct form actions or AJAX to PHP handlers
- [ ] Create PHP handlers for CRUD operations (menu_handler.php, promo_handler.php, inventory_handler.php, customer_handler.php, order_handler.php) to replace API functionality
- [ ] Update form actions in dashboard_admin.php to point to the new handlers
- [ ] Test dashboard functionality after changes
- [ ] Test menu page displays dynamic data
- [ ] Remove or deprecate API files if no longer needed
- [ ] Update any other references to APIs
