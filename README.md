### Admin-Side:
Create an admin-side page under the Settings tab with the following fields:

**1. Text  Editor:** For adding the text that will be displayed as an alert on the front end.
**2. Checkboxes:** For selecting custom post types to show the alert on:
    - Example checkboxes could include:
   - Posts
   - Pages
   - Custom Post Types (e.g., Events, Products)
   
**3. Multi-Select Box:** For each checked post type, list all posts of that type in a multi-select box, allowing the admin to select multiple posts to show the alert on.
**4.Background Color:** Option to select the background color for the alert box.
**5.Font Color:** Option to select the font color for the alert box text.
**6.Position:** Option to select the position of the alert box on the page.
**7.Padding:** Option to select the padding for the alert box.
**8. Save Changes Button:** To save the changes made.
**Example:**
    – posts
    – pages
The page allows admins to:
- Check custom post types
- Select specific posts to show the alert on
- Save changes
**see the screenshot  look like in Back end :** 
![Screenshot 2024-11-27 at 3 06 23 PM](https://github.com/user-attachments/assets/ff3bb55b-3fd4-4976-925a-df1b42951748)

### Front-End:
When users visit a page, post, or custom post type that has been selected on the admin side, an alert box will pop up. The alert box will display the text entered by the admin in the settings page.
**see the screenshot  look like in front end :** 
![Screenshot 2024-11-27 at 3 07 33 PM](https://github.com/user-attachments/assets/6a99b0c7-bd0c-4097-a163-69ba01ca523a)

### Plugin Standards:
This plugin follows typical WordPress plugin standards. It ensures compatibility with custom post types, supports the admin interface for easy configuration, and displays alerts on the front end based on the admin's selections.
[https://github.com/DevinVinson/WordPress-Plugin-Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate)
