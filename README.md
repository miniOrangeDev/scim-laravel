# What is SCIM?
**SCIM**, which stands for **System for Cross-domain Identification Management**, is an open standard that facilitates in the automation of the user identity lifecycle management process. SCIM Provisioning facilitates the communication of cloud-based applications by formalising the integration of Identity Providers (e.g., Directories) as well as Service Providers (i.e. SaaS apps you need to access). When SCIM Provisioning is enabled, 'Create,' 'Update,' and 'Delete' operations performed in the IDP (where user data is stored) are automatically synchronised with the SPs (SaaS apps like Salesforce, AWS, Zoom, and others). This increases user data security while also simplifying the user lifecycle management process.

# Laravel SCIM 
The package is for **SCIM Provisioning / Laravel SCIM Automated User Provisioning / Laravel User Sync**.
It allows you to configure real-time Laravel SCIM user provisioning and enable automated Laravel user sync from IDPs like Azure AD, Okta, GSuite/Google Apps / Google Workspace, Keycloak, Centrify, One Login, PingOne, Jumpcloud, miniOrange, etc. Our Laravel SCIM package helps you to automate user creation, update and delete user information from the IDP (Identity Provider) in real-time to your Laravel site. 

## Requirements
* Laravel - 5.0+
* PHP - ^5.1 || ^7.1 || ^8.0

## Installation - Composer
1. Install the package via composer in your Laravel app's main directory.
````
composer require miniorange/scim-laravel
````

1. After successful installation of package, go to your Laravel app in the browser and enter

   ***{laravel-application-domain}/mo_scim_admin***

2. The package will start setting up your database for you and then redirect you to the admin registration page where you can register or login with miniOrange and setup SCIM Provisioning.

    ![This is package login page](https://plugins.miniorange.com/wp-content/uploads/2023/03/register-miniorange-admin-laravel.webp)
    
## Configuring the package

1. Copy the **SCIM Base URL** and **SCIM Bearer Token** from and paste it in your IdP.

    ![This is package settings page](https://plugins.miniorange.com/wp-content/uploads/2023/03/laravel-scim-dashboard-url-token.webp)
    
2. In the name field, select the **SCIM Attribute** from the dropdown the SCIM attribute you want to map with name column of your laravel user table.

    ![This is package settings page](https://plugins.miniorange.com/wp-content/uploads/2023/03/scim-setting-map-scim-attributes.webp)

3. Click on Save button.
    
## Perform SCIM Operations

 Once you have configured your IdP with the plugin, you will be able to perform the following operations:

1. ***Create Users***: The users will automatically be created on your Laravel site when created on your IdP.
2. ***Update Users***: The users will automatically be updated on your Laravel site when updated on your IdP.
3. ***Delete/De-provision***: The users will automatically be deleted from your Laravel site users list when deleted from your IdP.

# Features
The features provided in the free and premium are listed here.

|                  Free Plan                  |                          Premium Plan                          |                            Enterprise Plan                             |
| :-----------------------------------------: | :------------------------------------------------------------: | :--------------------------------------------------------------------: |
|                Create Users                 |                          Create Users                          |                              Create Users                              |
| Update user's email, firstName and lastName | Update user's email, firstName, lastName and Custom Attributes | Update user's email, firstName, lastName, Custom Attributes and Groups |
|               Unlimited Users               |                        Unlimited Users                         |                            Unlimited Users                             |
|           Real-time Provisioning            |                     Real-time Provisioning                     |                         Real-time Provisioning                         |
|            Pre-configured IdP's             |                      Pre-configured IdP's                      |                          Pre-configured IdP's                          |
|                      ***Not Available***                      |                    Delete/Deprovision Users                    |                        Delete/Deprovision Users                        |
|                      ***Not Available***                      |                        Deactivate Users                        |                            Deactivate Users                            |
|                      ***Not Available***                      |                       Attribute Mapping                        |                           Attribute Mapping                            |
|                      ***Not Available***                      |                               ***Not Available***                                |                             Group Mapping                              |
|                      ***Not Available***                      |                               ***Not Available***                                |                               Audit Logs                               |
|                      ***Not Available***                      |                               ***Not Available***                                |                 Buddypress/BuddyBoss Attribute Mapping                 |


# Feature Description

* **Real-time Provisioning**

    Automatically Provision newly created or updated Users in your Identity Provider into _Laravel Application_ in Real Time.

* **Delete/Deprovision Users**

    Automatic User Deprovisioning feature enables deactivation /deletion of user accounts on your Laravel site when user is deleted / unassigned / removed from your IdP.

* **Attribute/Group Mapping**

    Map and update Laravel user attributes/groups automatically from your IdP.

# Contact Us
For more details you can visit our [**website**](https://plugins.miniorange.com/laravel-user-provisioning) or contact us at [**laravelsupport@xecurify.com**](mailto:laravelsupport@xecurify.com).