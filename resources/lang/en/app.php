<?php

return [
    
    /* CHANNELS */
        "channel_test_message" => "Message from google analytics reporting application",
        "channel_test_success" => "Message send",
        "channel_test_error" => "An error occurred during test",
        "channel_delete_success" => "Channel deleted",
        "channel_delete_error" => "An error occurred while deleting the channel",

    /* GOOGLE */
        "google_add_success" => "Google account added",
        "google_add_empty_account" => "You don't have google analytics account",
        "google_logout_success" => "Google account disconnected",
        "google_test_success" => "Account :datas sessions last 7 days ",
        "google_test_error" => "An error occurred during test",
        "google_delete_success" => "Account deleted",
        "google_delete_error" => "An error occurred while deleting the account",

    /* SLACK */
        "slack_install_error" => "An error occurred during authentication",
        "slack_add_success" => "Channel added",
        "slack_add_error" => "An error occurred while addind the channel",

    /* REPORTINGS */
        "reporting_add_success" => "Reporting saved",
        "reporting_add_error" => "An error occurred while saving the reporting",
        "reporting_edit_success" => "Reporting edited",
        "reporting_edit_error" => "An error occurred while editing the reporting",
        "reporting_delete_success" => "Repporting deleted",
        "reporting_delete_error" => "An error occurred while deleting the reporting",
        "reporting_test_success" => "Reporting sended",
        "reporting_test_error" => "An error occurred while testing the reporting",

        "reporting_report_daily_message" => "Summary *:name* of yesterday",
        "reporting_report_weekly_message" => "Summary *:name* from :first to :last",

    /* METRICS */
        "metric_placeholder" => "Select some metrics",
        "metric_ga:pageviews" => "Page views", 
        "metric_ga:users" => "Users", 
        "metric_ga:percentNewSessions" => "% new sessions", 
        "metric_ga:sessions" => "Sessions", 
        "metric_ga:sessionDuration" => "Total duration of sessions", 
        "metric_ga:bounces" => "Bounces", 
        "metric_ga:avgSessionDuration" => "Average time per session", 
        "metric_ga:uniquePageviews" => "Unique page views", 
        "metric_ga:avgTimeOnPage" => "Average time on page", 


    /* NOTIFICATIONS */
        "notification_1" => "Everyday",
        "notification_2" => "Every Week",
        "notification_3" => "Every Month",

    /* TEMPLATE */
        "alert_info" => "I recently added all the metrics for your reports. If you encounter errors (empty reports) with them, please report it.",
        "password" => "Password",
        "login" => "Login",
        "register" => "Sign up",
        "name" => "Name",
        "color" => "Color",
        "install" => "Install",
        "support" => "Support",
        "logout" => "Logout",
        "footer_rights" => "All rights reserved",
        "channels" => "Channels",
        "channel" => "Channel",
        "google_accounts" => "Google accounts",
        "reportings" => "Reportings",
        "notifications" => "Notifications",
        "metrics" => "Metrics",
        "timezone" => "Timezone",

        "button_delete" => "Delete",
        "button_test" => "Test",
        "button_edit" => "Edit",
        "button_addreporting" => "Add the reporting",
        "button_editreporting" => "Edit the reporting",

        "forget_password" => "Forget password",
        "forget_password_description" => "Get the link via email to change your password",
        "forget_password_resend_button" => "Resend password",

        "change_password" => "Update password",
        "change_password_resend_button" => "Update the password",

        "login_description" => "Login to access the features of the application",
        "login_keep_login" => "Keep login",

        "register_description" => "Register to access the features of the application",

        "channels_mychannels" => "My channels",
        "channels_nochannel" => "Sorry you do not have chanel",
        "channels_addchannel" => "Add a channel to Slack",

        "google_myaccounts" => "My google accounts",
        "google_noaccount" => "Sorry you do not associate Google analytic account",
        "google_addaccount" => "Add a google account",

        "reportings_myreportings" => "My reportings",
        "reportings_noreporting" => "Sorry you do not have reporting",
        "reportings_createreporting" => "Create a reporting",
        "reportings_addreporting" => "Add a reporting",
        "reportings_editreporting" => "Edit a reporting",
        "reportings_selectchannel" => "Select a channel",
        "reportings_selectgoogleaccount" => "Select an account",
        "reportings_selectnotifications" => "Select the frequency of notifications",
        "reportings_selecttimezone" => "Select your timezone for notifications",


        "support_title" => "A request to send me",
        "support_description" => "For problems with the site or any other suggestions, thank you to contact me at the following address",

        "install_title1" => 'Install',
        "install_title2" => 'your reportings',
        "install_title3" => 'in few clics',
        "install_description" => "First, register on the site",
        "install_step1_title1" => "Create an",
        "install_step1_title2" => "account",
        "install_step1_subtitle" => "Resgister on the application",
        "install_step1_description" => "For security reasons, it is necessary that for each user an account is created",
        "install_step2_title1" => "Save your",
        "install_step2_title2" => "channel",
        "install_step2_subtitle" => "Link your account to slack",
        "install_step2_description" => "Once registered, click the slack button on the home page and connect your account to slack",
        "install_step3_title1" => "Save your",
        "install_step3_title2" => "google analytics account",
        "install_step3_subtitle" => "Link your google analytics account to the application",
        "install_step3_description" => "Connect to your google account to import accounts that interests you",
        "install_step4_title1" => "Create your",
        "install_step4_title2" => "reportings",
        "install_step4_subtitle" => "Create custom reportings",
        "install_step4_description" => "Create and configure your reportings to match up to your expectations (metric, color, frequency of notifications, ...)",
        "install_step5_title1" => "It's",
        "install_step5_title2" => "done",
        "install_step5_subtitle" => "Everything is configured, let's tested",
        "install_step5_description" => "Test your configuration and data by clicking the test button of your reporting. A notification should appear in your channel slack. If an error occurs, thank you to contact support",
        "install_step5_button" => "Contact the support",


        "home_title1" => 'Do not waste',
        "home_title2" => 'time',
        "home_title3" => 'on google analytics',
        "home_description" => "Get your reportings directly on slack",
        "home_step1_title1" => "Configure yours reportings",
        "home_step1_title2" => "Customised",
        "home_step1_subtitle" => "From your google account",
        "home_step1_description" => "Configure your custom reportings from the site. You can connect as many channel and google accounts as you like. Easy to learn, it takes only 3 minutes to configure",
        "home_step2_title1" => "Receive",
        "home_step2_title2" => "your reportings",
        "home_step2_title3" => "periodically",
        "home_step2_subtitle" => "Get your reporingts periodically directly on your mobile",
        "home_step2_description" => "Get your reports directly on the channels selected with the desired metric analytics. It's simple, fast and effective",
        "home_call_title" => "Start using it",
        "home_call_description" => "Learn how to install the application",
        "home_call_button" => "Install",


        "policy"=>"privacy policy",
        "policy_description" => "Faced with the development of new communication tools, it is necessary to care special attention to the protection of privacy. That is why we are committed to respecting the confidentiality of personal information we collect.",
        "policy_title1" => "Collection of Personal Information",
        "policy_description1" => "We collect the following information: Name and Email Address. The personal information we collect is collected through forms and through the interactivity between you and our website. We also use, as shown in the following section, cookies and / or log files to collect information about you.",
        "policy_title2" => "Forms and interactivity",
        "policy_description2" => "Your personal information is collected through the registration form website.",
        "policy_title3" => "Right of opposition",
        "policy_description3" => "We are committed to providing you the right to object and withdrawing about your personal information. The right to object is defined as the possibility for users to refuse that their personal information used for certain purposes mentioned in the collection. The right of withdrawal is defined as the possibility for users to request that their personal information no longer included, for example, in a mailing list. To exercise these rights, you can contact me by email support-ga-reporting@ga-creation.fr",
        "policy_title4" => "Permission to access",
        "policy_description4" => "We are committed to recognizing the right of access and rectification to data subjects wishing to access, modify or delete their information about them. The exercise of this right will be by email to support-ga-reporting@ga-creation.fr ",
        "policy_title5" => "Security",
        "policy_description5" => "The personal information we collect is kept in a secure environment. People working for us are obliged to respect the confidentiality of your information. To ensure the security of your personal information, we use the following measures: Access management - authorized person, network monitoring software, computer backup, Username / password, firewall (firewalls). We are committed to maintaining a high degree of confidentiality by integrating the latest technological innovations to ensure the confidentiality of your transactions. However, as no mechanism offers maximum security, some risk is always present when the Internet is used to transmit personal information.",

];



