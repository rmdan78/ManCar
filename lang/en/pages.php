<?php

return [
    "auth" => [
        "signIn" => [
            "title"                 => "Sign In",
            "username"              => "Employee ID / Username",
            "usernamePlaceholder"   => "Type ID or Username here . . .",
            "password"              => "Kata Sandi",
            "passwordPlaceholder"   => "*************",
            "forgotPassword"        => "Forgot your password?",
            "submit"                => "Submit",
        ],
    ],
    "dashboard" => [
        "title" => "Dashboard",
        "completedRequests" => "Completed Requests",
        "topUsers" => "Top Users",
        "stats" => [
            "usersDesc" => "List all users of current employees",
            "vehiclesDesc" => "List of all registered vehicles",
            "requestsDesc" => "List of all recorded requests",
        ]
    ],
    "requests" => [
        "title"                 => "Requests",
        "add"                   => "Add",
        "approve"               => "Approve",
        "reject"                => "Reject",
        "editText"              => "Edit",
        "complete"              => "Complete",
        "filter"                => "Filter",
        "approveTooltip"        => "Approve selected item(s)",
        "rejectTooltip"         => "Reject selected item(s)",
        "editTooltip"           => "Edit selected item",
        "completeTooltip"       => "Complete selected item",
        "filterTooltip"         => "Filter data",
        "approveConfirmation"   => "Are you sure to approve them?",
        "rejectConfirmation"    => "Are you sure to reject them?",
        "completeConfirmation"  => "Are you sure to complete them?",
        "status" => [
            "approved"          => "Approved",
            "rejected"          => "Rejected",
            "pending"           => "Pending",
            "ongoing"           => "On Going",
            "completed"         => "Complete",
            "expired"           => "Expired",
        ],
        "filterFields" => [
            "transactionStatus" => "Transaction Status",
            "fromDate" => "From Date",
            "untilDate" => "Until Date",
            "perPage" => "Per Page",
            "page" => "Page",
        ],
        "tableFields" => [
            "request"       => "Request",
            "usageTime"     => "Usage Time",
            "destination"   => "Destination",
            "vehicle"       => "Vehicle",
            "status"        => "Status",
        ],
        "create" => [
            "title" => "Add New Request",
            "formFields" => [
                "destination"               => "Destination",
                "usedOn"                    => "Used On",
                "endsOn"                    => "Ends On",
                "description"               => "Description",
                "destinationPlaceholder"    => "Type destination here . . .",
                "descriptionPlaceholder"    => "Type description here . . .",
            ]
        ],
        "edit" => [
            "title" => "Edit Request",
            "formFields" => [
                "destination"               => "Destination",
                "usedOn"                    => "Used On",
                "endsOn"                    => "Ends On",
                "description"               => "Description",
                "destinationPlaceholder"    => "Type destination here . . .",
                "descriptionPlaceholder"    => "Type description here . . .",
            ]
        ],
    ],
    "vehicles" => [
        "title"     => "Vehicles",
        "add"       => "Add",
        "delete"    => "Delete",
        "editText"  => "Edit",
        "deleteConfirm" => "Are you sure to delete it?",
        "status" => [
            "available" => "Available",
            "inused"    => "In Used",
        ],
        "create" => [
            "title" => "Add New Vehicle",
            "formFields" => [
                "thumbnail"                 => "Thumbnail",
                "name"                      => "Name",
                "boughtOn"                  => "Bought On",
                "color"                     => "Color",
                "vehicleKind"               => "Vehicle Kind",
                "numberPlate"               => "Number Plate",
                "description"               => "Description",
                "descriptionPlaceholder"    => "Type description here . . .",
            ],
        ],
        "edit" => [
            "title" => "Edit Vehicle",
            "formFields" => [
                "thumbnail"                 => "Thumbnail",
                "name"                      => "Name",
                "boughtOn"                  => "Bought On",
                "color"                     => "Color",
                "vehicleKind"               => "Vehicle Kind",
                "numberPlate"               => "Number Plate",
                "description"               => "Description",
                "descriptionPlaceholder"    => "Type description here . . .",
            ],
        ],
    ],
    "users" => [
        "title"                 => "Users",
        "add"                   => "Add",
        "recover"               => "Recover",
        "disable"               => "Disable",
        "editText"              => "Edit",
        "recoverTooltip"        => "Recover selected item(s)",
        "disableTooltip"        => "Disable selected item(s)",
        "editTooltip"           => "Edit selected item",
        "recoverConfirmation"   => "Are you sure to recover them?",
        "disableConfirmation"    => "Are you sure to disable them?",
        "status" => [
            "active"    => "Active",
            "inactive"  => "Inactive",
        ],
        "tableFields" => [
            "name"          => "Name",
            "roles"         => "Roles",
            "status"        => "Status",
        ],
        "create" => [
            "title" => "Tambah User Baru",
            "formFields" => [
                "profilePicture"            => "Profile Picture",
                "name"                      => "Name",
                "employeeId"                => "Employee ID",
                "email"                     => "Email",
                "roles"                     => "Roles",
                "password"                  => "Password",
                "passwordWarning"           => "User must change his password after his first login"
            ],
        ],
        "edit" => [
            "title" => "Sunting User",
            "formFields" => [
                "profilePicture"            => "Profile Picture",
                "name"                      => "Name",
                "employeeId"                => "Employee ID",
                "email"                     => "Email",
                "roles"                     => "Roles",
                "password"                  => "Password",
            ],
        ],
    ],
    "profile" => [
        "title" => "Profile",
        "status" => [
            "active"    => "Active",
            "inactive"  => "Inactive",
        ],
        "edit" => [
            "title" => "Update Profile",
            "formFields" => [
                "profilePicture"            => "Profile Picture",
                "name"                      => "Name",
                "employeeId"                => "Employee ID",
                "email"                     => "Email",
                "roles"                     => "Roles",
                "password"                  => "Password",
            ],
        ],
        "password" => [
            "title" => "Password",
            "edit" => [
                "title" => "Update Password",
                "formFields" => [
                    "oldPassowrd"       => "Old Password",
                    "newPassword"       => "New Password",
                    "retypeNewPassword" => "Retype New Password",
                ],
            ],
        ],
    ],
];
