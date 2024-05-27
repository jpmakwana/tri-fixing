<?php

require_once("function.class.php");
class Log extends Functions
{
	public $db;
	public $ctable = "activity_log";
	public $ctableEmail = "email";
	public $activity_type = array("insert", "update", "delete", "view");
	public $slm = array(


		//Duplicate Record
		"DUPLICATE_RECORED_FOUND" => "Duplication! Already Exist this Name.",
		"DUPLICATE_MOBILE_FOUND" => "Already Exist this Mobile Number! Please Try to Another Mobile Number.",

		//user 
		"USER_INSERT_SUCESS" => " User Insert Successfully.",
		"USER_INSERT_FAILED" => " User Insert Failed.",
		"USER_UPDATE_SUCESS" => " User Update Successfully.",
		"USER_UPDATE_FAILED" => " User Update Failed.",
		"USER_DELETE_SUCESS" => " User Deleted",
		"USER_DELETE_FAILED" => " User Deleted Failed",
		"USER_GET_SUCESS"	  => "User Detail Get Successfully.",
		"USER_GET_FAILED"	  => "User Detail Get Failed.",
		"USER_STATUS_SUCESS"	  => "User Status Updated Successfully.",
		"USER_STATUS_FAILED"	  => "User Status Updated Successfully.",



		//Customer 
		"CUSTOMER_INSERT_SUCESS" => "Customer Inserted Successfully.",
		"CUSTOMER_INSERT_FAILED" => "Failed! Customer not Inserted.",
		"CUSTOMER_UPDATE_SUCESS" => "Customer Updated Successfully.",
		"CUSTOMER_UPDATE_FAILED" => "Customer Update Failed.",
		"CUSTOMER_GET_SUCCESS" => "Success! Update Customer Successfully.",
		"CUSTOMER_STATUS_SUCESS" => "Customer Status Updated Successfully.",
		"CUSTOMER_STATUS_FAILED" => "Customer Status Updated Failed.",
		"CUSTOMER_DELETE" => "Customer Deleted Successfully.",
		"CUSTOMER_DELETE_FAILED" => "Customer Deleted Failed.",
		"CUSTOMER_CART_NOT_FOUND" => "Customer Cart Not Found.",
		"CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST" => "Product Not Available For This Branch.",
		"CUSTOMER_NOT_FOUND" => "Customer not found",
		"CART_BRANCH_UPDATED" => "Branch updated successfully",
		"CART_UPDATED" => "Cart updated successfully",
		"RETURN_FOUND" => "Return found",
		"RETURN_NOT_FOUND" => "Return Not found",
		"RETURN_DETAIL_FOUND" => "Return Detail Found",
		"VENDOR_APPROVED" => "Vendor Approved Successfully.",
		"VENDOR_APPROVED_FAILED" => "Vendor Approved Failed.",
		"STATUS_CHANGE" => "Status Change Successfully.",
		"STATUS_CHANGE_FAILED" => "Status Change Failed.",

		"CONTACT_INSERT_SUCESS" => "Inquiry Inserted Successfully.",
		"CONTACT_INSERT_FAILED" => "Failed! Inquiry not Inserted .",


		//Movie Language 
		"MOVIE_LANGUAGE_INSERT_SUCESS" => "Movie Language  Inserted Successfully.",
		"MOVIE_LANGUAGE_INSERT_FAILED" => "Failed! Movie Language  not Inserted.",
		"MOVIE_LANGUAGE_UPDATE_SUCESS" => "Movie Language  Updated Successfully.",
		"MOVIE_LANGUAGE_UPDATE_FAILED" => "Movie Language  Update Failed.",
		"MOVIE_LANGUAGE_GET_SUCCESS" => "Success! Update Movie Language  Successfully.",
		"MOVIE_LANGUAGE_GET_FAILED" => "Failed! Update Movie Language  Successfully.",
		"MOVIE_LANGUAGE_STATUS_SUCESS" => "Movie Language  Status Updated Successfully.",
		"MOVIE_LANGUAGE_STATUS_FAILED" => "Movie Language  Status Updated Failed.",
		"MOVIE_LANGUAGE_DELETE" => "Movie Language  Deleted Successfully.",
		"MOVIE_LANGUAGE_DELETE_FAILED" => "Movie Language  Deleted Failed.",


		//Food & Beverage Category
		"FBCATEGORY_INSERT_SUCESS" => "Food & Beverage Category Inserted Successfully.",
		"FBCATEGORY_INSERT_FAILED" => "Failed! Food & Beverage Category not Inserted.",
		"FBCATEGORY_UPDATE_SUCESS" => "Food & Beverage Category  Updated Successfully.",
		"FBCATEGORY_UPDATE_FAILED" => "Food & Beverage Category Update Failed.",
		"FBCATEGORY_GET_SUCCESS" => "Success! Update Food & Beverage Category Successfully.",
		"FBCATEGORY_GET_FAILED" => "Failed! Update Food & Beverage Category  Successfully.",
		"FBCATEGORY_STATUS_SUCESS" => "Food & Beverage Category Status Updated Successfully.",
		"FBCATEGORY_STATUS_FAILED" => "Food & Beverage Category Status Updated Failed.",
		"FBCATEGORY_DELETE" => "Food & Beverage Category  Deleted Successfully.",
		"FBCATEGORY_DELETE_FAILED" => "Food & Beverage Category  Deleted Failed.",

		//Food Category
		"FOOD_INSERT_SUCESS" => "Food Category Inserted Successfully.",
		"FOOD_INSERT_FAILED" => "Failed! Food Category not Inserted.",
		"FOOD_UPDATE_SUCESS" => "Food Category  Updated Successfully.",
		"FOOD_UPDATE_FAILED" => "Food Category Update Failed.",
		"FOOD_GET_SUCCESS" => "Success! Update Food Category Successfully.",
		"FOOD_GET_FAILED" => "Failed! Update Food Category  Successfully.",
		"FOOD_STATUS_SUCESS" => "Food Category Status Updated Successfully.",
		"FOOD_STATUS_FAILED" => "Food Category Status Updated Failed.",
		"FOOD_DELETE" => "Food Category  Deleted Successfully.",
		"FOOD_DELETE_FAILED" => "Food Category  Deleted Failed.",



		//Quotation
		"QUOTATION_INSERT_SUCESS" => "Quotation Inserted Successfully.",
		"QUOTATION_INSERT_FAILED" => "Failed! Quotation not Inserted.",
		//loan

		"LOAN_INSERT_SUCESS" => "Loan Inserted Successfully.",
		"LOAN_INSERT_FAILED" => "Failed! Loan not Inserted.",
		"LOAN_UPDATE_SUCESS" => "Loan Updated Successfully.",
		"LOAN_UPDATE_FAILED" => "Loan Update Failed.",
		"LOAN_GET_SUCCESS" => "Success! Update Loan Successfully.",
		"LOAN_STATUS_SUCESS" => "Loan Status Updated Successfully.",
		"LOAN_STATUS_FAILED" => "Loan Status Updated Failed.",
		"LOAN_DELETE" => "Loan Deleted Successfully.",
		"LOAN_DELETE_FAILED" => "Loan Deleted Failed.",


		//insurance
		"INSURANCE_INSERT_SUCESS" => "Insurance Inserted Successfully.",
		"INSURANCE_INSERT_FAILED" => "Failed! Insurance not Inserted.",
		"INSURANCE_UPDATE_SUCESS" => "Insurance Updated Successfully.",
		"INSURANCE_UPDATE_FAILED" => "Insurance Update Failed.",
		"INSURANCE_GET_SUCCESS" => "Success! Update Insurance Successfully.",
		"INSURANCE_STATUS_SUCESS" => "Insurance Status Updated Successfully.",
		"INSURANCE_STATUS_FAILED" => "Insurance Status Updated Failed.",
		"INSURANCE_DELETE" => "Insurance Deleted Successfully.",
		"INSURANCE_DELETE_FAILED" => "Insurance Deleted Failed.",

		//Vendor
		"VENDOR_INSERT" => "Vendor Inserted Successfully.",
		"VENDOR_INSERT_FAILED" => "Failed! Vendor not Inserted.",
		"VENDOR_UPDATE" => "Vendor Updated Successfully.",
		"VENDOR_UPDATE_FAILED" => "Vendor Update Failed.",
		"VENDOR_GET_SUCCESS" => "Success! Update Vendor Successfully.",
		"VENDOR_STATUS_SUCESS" => "Vendor Status Updated Successfully.",
		"VENDOR_STATUS_FAILED" => "Vendor Status Updated Failed.",
		"VENDOR_DELETE" => "Vendor Deleted Successfully.",
		"VENDOR_DELETE_FAILED" => "Vendor Deleted Failed.",

		//Purchase Order
		"PURCHASE_ORDER_INSERT_SUCESS" => "Purchase Order Insert Successfully.",
		"PURCHASE_ORDER_INSERT_FAILED" => "Purchase Order Insert Failed.",
		"PURCHASE_ORDER_UPDATE_SUCESS" => "Purchase Order Update Successfully.",
		"PURCHASE_ORDER_UPDATE_FAILED" => "Purchase Order Update Failed.",
		"PURCHASE_ORDER_DELETE_SUCESS" => "Purchase Order Delete Successfully.",
		"PURCHASE_ORDER_DELETE_FAILED" => "Purchase Order Delete Failed.",
		"PURCHASE_ORDER_GET_SUCESS"   => "Purchase Order Detail Get Successfully.",
		"PURCHASE_ORDER_GET_FAILED"   => "Purchase Order Detail Get Failed.",
		"PURCHASE_ORDER_STATUS_SUCESS" => "Purchase Order Status Update Successfully.",
		"PURCHASE_ORDER_STATUS_FAILED" => "Purchase Order Status Update Failed.",

		//Inward Store
		"INWARD_STORE_INSERT_SUCESS" => "Inward Store Insert Successfully.",
		"INWARD_STORE_INSERT_FAILED" => "Inward Store Insert Failed.",
		"INWARD_STORE_UPDATE_SUCESS" => "Inward Store Update Successfully.",
		"INWARD_STORE_UPDATE_FAILED" => "Inward Store Update Failed.",
		"INWARD_STORE_DELETE_SUCESS" => "Inward Store Delete Successfully.",
		"INWARD_STORE_DELETE_FAILED" => "Inward Store Delete Failed.",
		"INWARD_STORE_GET_SUCESS"   => "Inward Store Detail Get Successfully.",
		"INWARD_STORE_GET_FAILED"   => "Inward Store Detail Get Failed.",
		"INWARD_STORE_STATUS_SUCESS" => "Inward Store Status Update Successfully.",
		"INWARD_STORE_STATUS_FAILED" => "Inward Store Status Update Failed.",

		//Product
		"PRODUCT_INSERT_SUCESS" => "Product Insert Successfully.",
		"PRODUCT_INSERT_FAILED" => "Product Insert Failed.",
		"PRODUCT_UPDATE_SUCESS" => "Product Update Successfully.",
		"PRODUCT_UPDATE_FAILED" => "Product Update Failed.",
		"PRODUCT_DELETE_SUCESS" => "Product Delete Successfully.",
		"PRODUCT_DELETE_FAILED" => "Product Delete Failed.",
		"PRODUCT_GET_SUCESS"   => "Product Detail Get Successfully.",
		"PRODUCT_GET_FAILED"   => "Product Detail Get Failed.",
		"PRODUCT_STATUS_SUCESS" => "Product Status Update Successfully.",
		"PRODUCT_STATUS_FAILED" => "Product Status Update Failed.",

		//Gallery
		"GALLERY_INSERT_SUCESS" => "Gallery Insert Successfully.",
		"GALLERY_INSERT_FAILED" => "Gallery Insert Failed.",
		"GALLERY_UPDATE_SUCESS" => "Gallery Update Successfully.",
		"GALLERY_UPDATE_FAILED" => "Gallery Update Failed.",
		"GALLERY_DELETE_SUCESS" => "Gallery Delete Successfully.",
		"GALLERY_DELETE_FAILED" => "Gallery Delete Failed.",
		"GALLERY_GET_SUCESS"   => "Gallery Detail Get Successfully.",
		"GALLERY_GET_FAILED"   => "Gallery Detail Get Failed.",
		"GALLERY_STATUS_SUCESS" => "Gallery Status Update Successfully.",
		"GALLERY_STATUS_FAILED" => "Gallery Status Update Failed.",

		//Coupon
		"COUPON_INSERT_SUCESS" => "Coupon Insert Successfully.",
		"COUPON_INSERT_FAILED" => "Coupon Insert Failed.",
		"COUPON_UPDATE_SUCESS" => "Coupon Update Successfully.",
		"COUPON_UPDATE_FAILED" => "Coupon Update Failed.",
		"COUPON_DELETE_SUCESS" => "Coupon Delete Successfully.",
		"COUPON_DELETE_FAILED" => "Coupon Delete Failed.",
		"COUPON_GET_SUCESS"   => "Coupon Detail Get Successfully.",
		"COUPON_GET_FAILED"   => "Coupon Detail Get Failed.",
		"COUPON_STATUS_SUCESS" => "Coupon Status Update Successfully.",
		"COUPON_STATUS_FAILED" => "Coupon Status Update Failed.",


		//Banner
		"BANNER_INSERT_SUCESS" => "Banner Insert Successfully.",
		"BANNER_INSERT_FAILED" => "Banner Insert Failed.",
		"BANNER_UPDATE_SUCESS" => "Banner Update Successfully.",
		"BANNER_UPDATE_FAILED" => "Banner Update Failed.",
		"BANNER_DELETE_SUCESS" => "Banner Delete Successfully.",
		"BANNER_DELETE_FAILED" => "Banner Delete Failed.",
		"BANNER_GET_SUCESS"   => "Banner Detail Get Successfully.",
		"BANNER_GET_FAILED"   => "Banner Detail Get Failed.",
		"BANNER_STATUS_SUCESS" => "Banner Status Update Successfully.",
		"BANNER_STATUS_FAILED" => "Banner Status Update Failed.",

		//Advertise
		"ADVERTISE_INSERT_SUCESS" => "Advertise Insert Successfully.",
		"ADVERTISE_INSERT_FAILED" => "Advertise Insert Failed.",
		"ADVERTISE_UPDATE_SUCESS" => "Advertise Update Successfully.",
		"ADVERTISE_UPDATE_FAILED" => "Advertise Update Failed.",
		"ADVERTISE_DELETE_SUCESS" => "Advertise Delete Successfully.",
		"ADVERTISE_DELETE_FAILED" => "Advertise Delete Failed.",
		"ADVERTISE_GET_SUCESS"   => "Advertise Detail Get Successfully.",
		"ADVERTISE_GET_FAILED"   => "Advertise Detail Get Failed.",
		"ADVERTISE_STATUS_SUCESS" => "Advertise Status Update Successfully.",
		"ADVERTISE_STATUS_FAILED" => "Advertise Status Update Failed.",


		//Offer
		"OFFERS_INSERT_SUCESS" => "Offer Insert Successfully.",
		"OFFERS_INSERT_FAILED" => "Offer Insert Failed.",
		"OFFERS_UPDATE_SUCESS" => "Offer Update Successfully.",
		"OFFERS_UPDATE_FAILED" => "Offer Update Failed.",
		"OFFERS_DELETE_SUCESS" => "Offer Delete Successfully.",
		"OFFERS_DELETE_FAILED" => "Offer Delete Failed.",
		"OFFERS_GET_SUCESS"   => "Offer Detail Get Successfully.",
		"OFFERS_GET_FAILED"   => "Offer Detail Get Failed.",
		"OFFERS_STATUS_SUCESS" => "Offer Status Update Successfully.",
		"OFFERS_STATUS_FAILED" => "Offer Status Update Failed.",

		//Voucher
		"VOUCHER_INSERT_SUCESS" => "Voucher Insert Successfully.",
		"VOUCHER_INSERT_FAILED" => "Voucher Insert Failed.",
		"VOUCHER_UPDATE_SUCESS" => "Voucher Update Successfully.",
		"VOUCHER_UPDATE_FAILED" => "Voucher Update Failed.",
		"VOUCHER_DELETE_SUCESS" => "Voucher Delete Successfully.",
		"VOUCHER_DELETE_FAILED" => "Voucher Delete Failed.",
		"VOUCHER_GET_SUCESS"   => "Voucher Detail Get Successfully.",
		"VOUCHER_GET_FAILED"   => "Voucher Detail Get Failed.",
		"VOUCHER_STATUS_SUCESS" => "Voucher Status Update Successfully.",
		"VOUCHER_STATUS_FAILED" => "Voucher Status Update Failed.",



		//Booking
		"BOOKING_INSERT_SUCESS" => "Booking Insert Successfully.",
		"BOOKING_INSERT_FAILED" => "Booking Insert Failed.",
		"BOOKING_UPDATE_SUCESS" => "Booking Update Successfully.",
		"BOOKING_UPDATE_FAILED" => "Booking Update Failed.",
		"BOOKING_DELETE_SUCESS" => "Booking Delete Successfully.",
		"BOOKING_DELETE_FAILED" => "Booking Delete Failed.",
		"BOOKING_GET_SUCESS"   => "Booking Detail Get Successfully.",
		"BOOKING_GET_FAILED"   => "Booking Detail Get Failed.",
		"BOOKING_STATUS_SUCESS" => "Booking Status Update Successfully.",
		"BOOKING_STATUS_FAILED" => "Booking Status Update Failed.",

		//Screen
		"SCREEN_INSERT_SUCESS" => "Screen Details Insert Successfully.",
		"SCREEN_INSERT_FAILED" => "Screen Details  Insert Failed.",
		"SCREEN_UPDATE_SUCESS" => "Screen Details  Update Successfully.",
		"SCREEN_UPDATE_FAILED" => "Screen Details  Update Failed.",
		"SCREEN_DELETE_SUCESS" => "Screen Details  Delete Successfully.",
		"SCREEN_DELETE_FAILED" => "Screen Details  Delete Failed.",
		"SCREEN_GET_SUCESS"   => "Screen Details  Detail Get Successfully.",
		"SCREEN_GET_FAILED"   => "Screen Details  Detail Get Failed.",
		"SCREEN_STATUS_SUCESS" => "Screen Details  Status Update Successfully.",
		"SCREEN_STATUS_FAILED" => "Screen Details  Status Update Failed.",


		//Seat
		"SEAT_INSERT_SUCESS" => "Seat Details Insert Successfully.",
		"SEAT_INSERT_FAILED" => "Seat Details  Insert Failed.",
		"SEAT_UPDATE_SUCESS" => "Seat Details  Update Successfully.",
		"SEAT_UPDATE_FAILED" => "Seat Details  Update Failed.",
		"SEAT_DELETE_SUCESS" => "Seat Details  Delete Successfully.",
		"SEAT_DELETE_FAILED" => "Seat Details  Delete Failed.",
		"SEAT_GET_SUCESS"   => "Seat Details  Detail Get Successfully.",
		"SEAT_GET_FAILED"   => "Seat Details  Detail Get Failed.",
		"SEAT_STATUS_SUCESS" => "Seat Details  Status Update Successfully.",
		"SEAT_STATUS_FAILED" => "Seat Details  Status Update Failed.",




		//Shows
		"SHOWS_INSERT_SUCESS" => "Movie Show Insert Successfully.",
		"SHOWS_INSERT_FAILED" => "Movie Show Insert Failed.",
		"SHOWS_UPDATE_SUCESS" => "Movie Show Update Successfully.",
		"SHOWS_UPDATE_FAILED" => "Movie Show Update Failed.",
		"SHOWS_DELETE_SUCESS" => "Movie Show Delete Successfully.",
		"SHOWS_DELETE_FAILED" => "Movie Show Delete Failed.",
		"SHOWS_GET_SUCESS"   => "Movie Show Detail Get Successfully.",
		"SHOWS_GET_FAILED"   => "Movie Show Detail Get Failed.",
		"SHOWS_STATUS_SUCESS" => "Movie Show Status Update Successfully.",
		"SHOWS_STATUS_FAILED" => "Movie Show Status Update Failed.",

		//Orders
		"ORDERS_INSERT_SUCESS" => "Order Insert Successfully.",
		"ORDERS_INSERT_FAILED" => "Order Insert Failed.",
		"ORDERS_UPDATE_SUCESS" => "Order Update Successfully.",
		"ORDERS_UPDATE_FAILED" => "Order Update Failed.",
		"ORDERS_DELETE_SUCESS" => "Order Delete Successfully.",
		"ORDERS_DELETE_FAILED" => "Order Delete Failed.",
		"ORDERS_GET_SUCESS"   => "Order Detail Get Successfully.",
		"ORDERS_GET_FAILED"   => "Order Detail Get Failed.",
		"ORDERS_STATUS_SUCESS" => "Order Status Update Successfully.",
		"ORDERS_STATUS_FAILED" => "Order Status Update Failed.",

		//Order Items
		"ORDERS_ITEMS_INSERT_SUCESS" => "Order Items Insert Successfully.",
		"ORDERS_ITEMS_INSERT_FAILED" => "Order Items Insert Failed.",
		"ORDERS_ITEMS_UPDATE_SUCESS" => "Order Items Update Successfully.",
		"ORDERS_ITEMS_UPDATE_FAILED" => "Order Items Update Failed.",
		"ORDERS_ITEMS_DELETE_SUCESS" => "Order Items Delete Successfully.",
		"ORDERS_ITEMS_DELETE_FAILED" => "Order Items Delete Failed.",
		"ORDERS_ITEMS_GET_SUCESS"   => "Order Items Detail Get Successfully.",
		"ORDERS_ITEMS_GET_FAILED"   => "Order Items Detail Get Failed.",
		"ORDERS_ITEMS_STATUS_SUCESS" => "Order Items Status Update Successfully.",
		"ORDERS_ITEMS_STATUS_FAILED" => "Order Items Status Update Failed.",


		//Alter Image
		"ALT_IMG_INSERT_SUCESS" => "Alter Image Insert Successfully.",
		"ALT_IMG_INSERT_FAILED" => "Alter Image Insert Failed.",
		"ALT_IMG_UPDATE_SUCESS" => "Alter Image Update Successfully.",
		"ALT_IMG_UPDATE_FAILED" => "Alter Image Update Failed.",
		"ALT_IMG_DELETE_SUCESS" => "Alter Image Delete Successfully.",
		"ALT_IMG_DELETE_FAILED" => "Alter Image Delete Failed.",
		"ALT_IMG_GET_SUCESS"   => "Alter Image Detail Get Successfully.",
		"ALT_IMG_GET_FAILED"   => "Alter Image Detail Get Failed.",
		"ALT_IMG_STATUS_SUCESS" => "Alter Image Status Update Successfully.",
		"ALT_IMG_STATUS_FAILED" => "Alter Image Status Update Failed.",


		//Blog
		"BLOG_INSERT_SUCESS" => "Blog Insert Successfully.",
		"BLOG_INSERT_FAILED" => "Blog Insert Failed.",
		"BLOG_UPDATE_SUCESS" => "Blog Update Successfully.",
		"BLOG_UPDATE_FAILED" => "Blog Update Failed.",
		"BLOG_DELETE_SUCESS" => "Blog Delete Successfully.",
		"BLOG_DELETE_FAILED" => "Blog Delete Failed.",
		"BLOG_GET_SUCESS"   => "Blog Detail Get Successfully.",
		"BLOG_GET_FAILED"   => "Blog Detail Get Failed.",
		"BLOG_STATUS_SUCESS" => "Blog Status Update Successfully.",
		"BLOG_STATUS_FAILED" => "Blog Status Update Failed.",

		//freeware product
		"FREEWARE_PRODUCT_INSERT_SUCESS" => "Freeware Product Insert Successfully.",
		"FREEWARE_PRODUCT_INSERT_FAILED" => "Freeware Product Insert Failed.",
		"FREEWARE_PRODUCT_UPDATE_SUCESS" => "Freeware Product Update Successfully.",
		"FREEWARE_PRODUCT_UPDATE_FAILED" => "Freeware Product Update Failed.",
		"FREEWARE_PRODUCT_DELETE_SUCESS" => "Freeware Product Delete Successfully.",
		"FREEWARE_PRODUCT_DELETE_FAILED" => "Freeware Product Delete Failed.",
		"FREEWARE_PRODUCT_GET_SUCESS"   => "Freeware Product Detail Get Successfully.",
		"FREEWARE_PRODUCT_GET_FAILED"   => "Freeware Product Detail Get Failed.",
		"FREEWARE_PRODUCT_STATUS_SUCESS" => "Freeware Product Status Update Successfully.",
		"FREEWARE_PRODUCT_STATUS_FAILED" => "Freeware Product Status Update Failed.",

		//Offer
		"OFFER_INSERT" => "Offer Insert Successfully.",
		"OFFER_UPDATE" => "Offer Update Successfully.",
		"OFFER_DELETE" => "Offer Delete Successfully.",
		"OFFER_GET_SUCESS"   => "Offer Detail Get Successfully.",
		"OFFER_GET_FAILED"   => "Offer Detail Get Failed.",
		"OFFER_NOT_FOUND"   => " Offer Not Available.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS"   => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED"   => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",

		//Sub Category Master
		"SUB_CATEGORY_INSERT_SUCESS" => "Sub Category Insert Successfully.",
		"SUB_CATEGORY_INSERT_FAILED" => "Sub Category Insert Failed.",
		"SUB_CATEGORY_UPDATE_SUCESS" => "Sub Category Update Successfully.",
		"SUB_CATEGORY_UPDATE_FAILED" => "Sub Category Update Failed.",
		"SUB_CATEGORY_DELETE_SUCESS" => "Sub Category Delete Successfully.",
		"SUB_CATEGORY_DELETE_FAILED" => "Sub Category Delete Failed.",
		"SUB_CATEGORY_GET_SUCESS" => "Sub Category Detail Get Successfully.",
		"SUB_CATEGORY_GET_FAILED" => "Sub Category Detail Get Failed.",
		"SUB_CATEGORY_STATUS_SUCESS" => "Sub Category Status Update Successfully.",
		"SUB_CATEGORY_STATUS_FAILED" => "Sub Category Status Update Failed.",


		//Department Master
		"DEPARTMENT_INSERT_SUCESS" => "Department Insert Successfully.",
		"DEPARTMENT_INSERT_FAILED" => "Department Insert Failed.",
		"DEPARTMENT_UPDATE_SUCESS" => "Department Update Successfully.",
		"DEPARTMENT_UPDATE_FAILED" => "Department Update Failed.",
		"DEPARTMENT_DELETE_SUCESS" => "Department Delete Successfully.",
		"DEPARTMENT_DELETE_FAILED" => "Department Delete Failed.",
		"DEPARTMENT_GET_SUCESS"   => "Department Detail Get Successfully.",
		"DEPARTMENT_GET_FAILED"   => "Department Detail Get Failed.",
		"DEPARTMENT_STATUS_SUCESS" => "Department Status Update Successfully.",
		"DEPARTMENT_STATUS_FAILED" => "Department Status Update Failed.",

		
		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS"   => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED"   => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",

		//Popup Master
		"POPUP_INSERT_SUCESS" => "Popup Insert Successfully.",
		"POPUP_INSERT_FAILED" => "Popup Insert Failed.",
		"POPUP_UPDATE_SUCESS" => "Popup Update Successfully.",
		"POPUP_UPDATE_FAILED" => "Popup Update Failed.",
		"POPUP_DELETE_SUCESS" => "Popup Delete Successfully.",
		"POPUP_DELETE_FAILED" => "Popup Delete Failed.",
		"POPUP_GET_SUCESS"   => "Popup Detail Get Successfully.",
		"POPUP_GET_FAILED"   => "Popup Detail Get Failed.",
		"POPUP_STATUS_SUCESS" => "Popup Status Update Successfully.",
		"POPUP_STATUS_FAILED" => "Popup Status Update Failed.",



		//FAQ Master
		"FAQ_INSERT_SUCESS" => "FAQ Insert Successfully.",
		"FAQ_INSERT_FAILED" => "FAQ Insert Failed.",
		"FAQ_UPDATE_SUCESS" => "FAQ Update Successfully.",
		"FAQ_UPDATE_FAILED" => "FAQ Update Failed.",
		"FAQ_DELETE_SUCESS" => "FAQ Delete Successfully.",
		"FAQ_DELETE_FAILED" => "FAQ Delete Failed.",
		"FAQ_GET_SUCESS"   => "FAQ Detail Get Successfully.",
		"FAQ_GET_FAILED"   => "FAQ Detail Get Failed.",
		"FAQ_STATUS_SUCESS" => "FAQ Status Update Successfully.",
		"FAQ_STATUS_FAILED" => "FAQ Status Update Failed.",


		//QUERY Master
		"QUERY_INSERT_SUCESS" => "Query Insert Successfully.",
		"QUERY_INSERT_FAILED" => "Query Insert Failed.",
		"QUERY_UPDATE_SUCESS" => "Query Update Successfully.",
		"QUERY_UPDATE_FAILED" => "Query Update Failed.",
		"QUERY_DELETE_SUCESS" => "Query Delete Successfully.",
		"QUERY_DELETE_FAILED" => "Query Delete Failed.",
		"QUERY_GET_SUCESS"   => "Query Detail Get Successfully.",
		"QUERY_GET_FAILED"   => "Query Detail Get Failed.",
		"QUERY_STATUS_SUCESS" => "Query Status Update Successfully.",
		"QUERY_STATUS_FAILED" => "Query Status Update Failed.",



		//Plan Master
		"PLAN_INSERT_SUCESS" => "Plan Insert Successfully.",
		"PLAN_INSERT_FAILED" => "Plan Insert Failed.",
		"PLAN_UPDATE_SUCESS" => "Plan Update Successfully.",
		"PLAN_UPDATE_FAILED" => "Plan Update Failed.",
		"PLAN_DELETE_SUCESS" => "Plan Delete Successfully.",
		"PLAN_DELETE_FAILED" => "Plan Delete Failed.",
		"PLAN_GET_SUCESS"   => "Plan Detail Get Successfully.",
		"PLAN_GET_FAILED"   => "Plan Detail Get Failed.",
		"PLAN_STATUS_SUCESS" => "Plan Status Update Successfully.",
		"PLAN_STATUS_FAILED" => "Plan Status Update Failed.",



		//Subscription Master
		"SUBSCRIPTION_INSERT_SUCESS" => "Subscription Insert Successfully.",
		"SUBSCRIPTION_INSERT_FAILED" => "Subscription Insert Failed.",
		"SUBSCRIPTION_UPDATE_SUCESS" => "Subscription Update Successfully.",
		"SUBSCRIPTION_UPDATE_FAILED" => "Subscription Update Failed.",
		"SUBSCRIPTION_DELETE_SUCESS" => "Subscription Delete Successfully.",
		"SUBSCRIPTION_DELETE_FAILED" => "Subscription Delete Failed.",
		"SUBSCRIPTION_GET_SUCESS"   => "Subscription Detail Get Successfully.",
		"SUBSCRIPTION_GET_FAILED"   => "Subscription Detail Get Failed.",
		"SUBSCRIPTION_STATUS_SUCESS" => "Subscription Status Update Successfully.",
		"SUBSCRIPTION_STATUS_FAILED" => "Subscription Status Update Failed.",


		//Testimonial
		"TESTIMONIAL_INSERT_SUCESS" => "Testimonial Insert Successfully.",
		"TESTIMONIAL_INSERT_FAILED" => "Testimonial Insert Failed.",
		"TESTIMONIAL_UPDATE_SUCESS" => "Testimonial Update Successfully.",
		"TESTIMONIAL_UPDATE_FAILED" => "Testimonial Update Failed.",
		"TESTIMONIAL_DELETE_SUCESS" => "Testimonial Delete Successfully.",
		"TESTIMONIAL_DELETE_FAILED" => "Testimonial Delete Failed.",
		"TESTIMONIAL_GET_SUCESS"   => "Testimonial Detail Get Successfully.",
		"TESTIMONIAL_GET_FAILED"   => "Testimonial Detail Get Failed.",
		"TESTIMONIAL_STATUS_SUCESS" => "Testimonial Status Update Successfully.",
		"TESTIMONIAL_STATUS_FAILED" => "Testimonial Status Update Failed.",


		//City Master
		"CITY_INSERT_SUCESS" => "City Insert Successfully.",
		"CITY_INSERT_FAILED" => "City Insert Failed.",
		"CITY_UPDATE_SUCESS" => "City Update Successfully.",
		"CITY_UPDATE_FAILED" => "City Update Failed.",
		"CITY_DELETE_SUCESS" => "City Delete Successfully.",
		"CITY_DELETE_FAILED" => "City Delete Failed.",
		"CITY_GET_SUCESS"	=> "City Detail Get Successfully.",
		"CITY_GET_FAILED"	=> "City Detail Get Failed.",
		"CITY_STATUS_SUCESS" => "City Status Update Successfully.",
		"CITY_STATUS_FAILED" => "City Status Update Failed.",


		//Review

		"REVIEW_DELETE_SUCESS" => "Review Delete Successfully.",
		"REVIEW_DELETE_FAILED" => "Review Delete Failed.",

		//Quotation

		"QUOTATION_DELETE_SUCESS" => "Quotation Delete Successfully.",
		"QUOTATION_DELETE_FAILED" => "Quotation Delete Failed.",

		//Image
		"IMAGE_INSERT_SUCESS" => "Image Insert Successfully.",
		"IMAGE_INSERT_FAILED" => "Image Insert Failed.",
		"IMAGE_DELETE_SUCESS" => "Image Delete Successfully.",
		"IMAGE_DELETE_FAILED" => "Image Delete Failed.",
		"IMAGE_UPDATE_SUCESS" => "Image Update Successfully.",
		"IMAGE_UPDATE_FAILED" => "Image Update Failed.",




		//Video
		"VIDEO_INSERT_SUCESS" => "Video Insert Successfully.",
		"VIDEO_INSERT_FAILED" => "Video Insert Failed.",
		"VIDEO_DELETE_SUCESS" => "Video Delete Successfully.",
		"VIDEO_DELETE_FAILED" => "Video Delete Failed.",
		"VIDEO_UPDATE_SUCESS" => "Video Update Successfully.",
		"VIDEO_UPDATE_FAILED" => "Video Update Failed.",
		"VIDEO_STATUS_SUCESS" => "Video Status Updated Successfully.",
		"VIDEO_STATUS_FAILED" => "Video Status Updated Failed.",


		//File
		"FILE_INSERT_SUCESS" => "File Insert Successfully.",
		"FILE_INSERT_FAILED" => "File Insert Failed.",
		"FILE_DELETE_SUCESS" => "File Delete Successfully.",
		"FILE_DELETE_FAILED" => "File Delete Failed.",
		"FILE_UPDATE_SUCESS" => "File Update Successfully.",
		"FILE_UPDATE_FAILED" => "File Update Failed.",
		"FILE_STATUS_SUCESS" => "File Status Updated Successfully.",
		"FILE_STATUS_FAILED" => "File Status Updated Failed.",

		//Book
		"BOOK_INSERT_SUCESS" => "Book Insert Successfully.",
		"BOOK_INSERT_FAILED" => "Book Insert Failed.",
		"BOOK_DELETE_SUCESS" => "Book Delete Successfully.",
		"BOOK_DELETE_FAILED" => "Book Delete Failed.",
		"BOOK_UPDATE_SUCESS" => "Book Update Successfully.",
		"BOOK_UPDATE_FAILED" => "Book Update Failed.",
		"BOOK_STATUS_SUCESS" => "Book Status Updated Successfully.",
		"BOOK_STATUS_FAILED" => "Book Status Updated Failed.",




		//Brand Master
		"BRAND_INSERT_SUCESS" => "Brand Insert Successfully.",
		"BRAND_INSERT_FAILED" => "Brand Insert Failed.",
		"BRAND_UPDATE_SUCESS" => "Brand Update Successfully.",
		"BRAND_UPDATE_FAILED" => "Brand Update Failed.",
		"BRAND_DELETE_SUCESS" => "Brand Delete Successfully.",
		"BRAND_DELETE_FAILED" => "Brand Delete Failed.",
		"BRAND_GET_SUCESS"	 => "Brand Detail Get Successfully.",
		"BRAND_GET_FAILED"	 => "Brand Detail Get Failed.",
		"BRAND_STATUS_SUCESS" => "Brand Status Update Successfully.",
		"BRAND_STATUS_FAILED" => "Brand Status Update Failed.",

		//Service Master
		"SERVICE_INSERT_SUCESS" => "Service Insert Successfully.",
		"SERVICE_INSERT_FAILED" => "Service Insert Failed.",
		"SERVICE_UPDATE_SUCESS" => "Service Update Successfully.",
		"SERVICE_UPDATE_FAILED" => "Service Update Failed.",
		"SERVICE_DELETE_SUCESS" => "Service Delete Successfully.",
		"SERVICE_DELETE_FAILED" => "Service Delete Failed.",
		"SERVICE_GET_SUCESS"	 => "Service Detail Get Successfully.",
		"SERVICE_GET_FAILED"	 => "Service Detail Get Failed.",
		"SERVICE_STATUS_SUCESS" => "Service Status Update Successfully.",
		"SERVICE_STATUS_FAILED" => "Service Status Update Failed.",

		//device problem Master
		"DEVICE_PROBLEM_INSERT_SUCESS" => "Device Problem Insert Successfully.",
		"DEVICE_PROBLEM_INSERT_FAILED" => "Device Problem Insert Failed.",
		"DEVICE_PROBLEM_UPDATE_SUCESS" => "Device Problem Update Successfully.",
		"DEVICE_PROBLEM_UPDATE_FAILED" => "Device Problem Update Failed.",
		"DEVICE_PROBLEM_DELETE_SUCESS" => "Device Problem Delete Successfully.",
		"DEVICE_PROBLEM_DELETE_FAILED" => "Device Problem Delete Failed.",
		"DEVICE_PROBLEM_GET_SUCESS"	 => "Device Problem Detail Get Successfully.",
		"DEVICE_PROBLEM_GET_FAILED"	 => "Device Problem Detail Get Failed.",
		"DEVICE_PROBLEM_STATUS_SUCESS" => "Device Problem Status Update Successfully.",
		"DEVICE_PROBLEM_STATUS_FAILED" => "Device Problem Status Update Failed.",


		//modal Master
		"MODAL_INSERT_SUCESS" => "Modal Insert Successfully.",
		"MODAL_INSERT_FAILED" => "Modal Insert Failed.",
		"MODAL_UPDATE_SUCESS" => "Modal Update Successfully.",
		"MODAL_UPDATE_FAILED" => "Modal Update Failed.",
		"MODAL_DELETE_SUCESS" => "Modal Delete Successfully.",
		"MODAL_DELETE_FAILED" => "Modal Delete Failed.",
		"MODAL_GET_SUCESS"	 => "Modal Detail Get Successfully.",
		"MODAL_GET_FAILED"	 => "Modal Detail Get Failed.",
		"MODAL_STATUS_SUCESS" => "Modal Status Update Successfully.",
		"MODAL_STATUS_FAILED" => "Modal Status Update Failed.",
		


		//Best Sellers Product Master
		"BESTSELLERS_INSERT_SUCESS" => "Best Sellers Product Insert Successfully.",
		"BESTSELLERS_INSERT_FAILED" => "Best Sellers Product Insert Failed.",
		"BESTSELLERS_UPDATE_SUCESS" => "Best Sellers Product Update Successfully.",
		"BESTSELLERS_UPDATE_FAILED" => "Best Sellers Product Update Failed.",
		"BESTSELLERS_DELETE_SUCESS" => "Best Sellers Product Delete Successfully.",
		"BESTSELLERS_DELETE_FAILED" => "Best Sellers Product Delete Failed.",
		"BESTSELLERS_GET_SUCESS"	 => "Best Sellers Product Detail Get Successfully.",
		"BESTSELLERS_GET_FAILED"	 => "Best Sellers Product Detail Get Failed.",
		"BESTSELLERS_STATUS_SUCESS" => "Best Sellers Product Status Update Successfully.",
		"BESTSELLERS_STATUS_FAILED" => "Best Sellers Product Status Update Failed.",

		//Unit Master
		"UNIT_INSERT_SUCESS" => "Unit Insert Successfully.",
		"UNIT_INSERT_FAILED" => "Unit Insert Failed.",
		"UNIT_UPDATE_SUCESS" => "Unit Update Successfully.",
		"UNIT_UPDATE_FAILED" => "Unit Update Failed.",
		"UNIT_DELETE_SUCESS" => "Unit Delete Successfully.",
		"UNIT_DELETE_FAILED" => "Unit Delete Failed.",
		"UNIT_GET_SUCESS"	=> "Unit Detail Get Successfully.",
		"UNIT_GET_FAILED"	=> "Unit Detail Get Failed.",
		"UNIT_STATUS_SUCESS" => "Unit Status Update Successfully.",
		"UNIT_STATUS_FAILED" => "Unit Status Update Failed.",


		//Designation
		"DESIGNATION_INSERT_SUCESS" => "Designation Insert Successfully.",
		"DESIGNATION_INSERT_FAILED" => "Designation Insert Failed.",
		"DESIGNATION_UPDATE_SUCESS" => "Designation Update Successfully.",
		"DESIGNATION_UPDATE_FAILED" => "Designation Update Failed.",
		"DESIGNATION_DELETE_SUCESS" => "Designation Delete Successfully.",
		"DESIGNATION_DELETE_FAILED" => "Designation Delete Failed.",
		"DESIGNATION_GET_SUCESS"	=> "Designation Detail Get Successfully.",
		"DESIGNATION_GET_FAILED"	=> "Designation Detail Get Failed.",
		"DESIGNATION_STATUS_SUCESS" => "Designation Status Update Successfully.",
		"DESIGNATION_STATUS_FAILED" => "Designation Status Update Failed.",



	

		//Popup Master
		"POPUP_INSERT_SUCESS" => "Popup Insert Successfully.",
		"POPUP_INSERT_FAILED" => "Popup Insert Failed.",
		"POPUP_UPDATE_SUCESS" => "Popup Update Successfully.",
		"POPUP_UPDATE_FAILED" => "Popup Update Failed.",
		"POPUP_DELETE_SUCESS" => "Popup Delete Successfully.",
		"POPUP_DELETE_FAILED" => "Popup Delete Failed.",
		"POPUP_GET_SUCESS"   => "Popup Detail Get Successfully.",
		"POPUP_GET_FAILED"   => "Popup Detail Get Failed.",
		"POPUP_STATUS_SUCESS" => "Popup Status Update Successfully.",
		"POPUP_STATUS_FAILED" => "Popup Status Update Failed.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS"   => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED"   => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",


		//ID Proof Master
		"IDPROOF_INSERT_SUCESS" => "ID Proof Insert Successfully.",
		"IDPROOF_INSERT_FAILED" => "ID Proof Insert Failed.",
		"IDPROOF_UPDATE_SUCESS" => "ID Proof Update Successfully.",
		"IDPROOF_UPDATE_FAILED" => "ID Proof Update Failed.",
		"IDPROOF_DELETE_SUCESS" => "ID Proof Delete Successfully.",
		"IDPROOF_DELETE_FAILED" => "ID Proof Delete Failed.",
		"IDPROOF_GET_SUCESS"	=> "ID Proof Detail Get Successfully.",
		"IDPROOF_GET_FAILED"	=> "ID Proof Detail Get Failed.",
		"IDPROOF_STATUS_SUCESS" => "ID Proof Status Update Successfully.",
		"IDPROOF_STATUS_FAILED" => "ID Proof Status Update Failed.",

		//packing type Master
		"PACKING_TYPE_INSERT_SUCESS" => "Packing Type Insert Successfully.",
		"PACKING_TYPE_INSERT_FAILED" => "Packing Type Insert Failed.",
		"PACKING_TYPE_UPDATE_SUCESS" => "Packing Type Update Successfully.",
		"PACKING_TYPE_UPDATE_FAILED" => "Packing Type Update Failed.",
		"PACKING_TYPE_DELETE_SUCESS" => "Packing Type Delete Successfully.",
		"PACKING_TYPE_DELETE_FAILED" => "Packing Type Delete Failed.",
		"PACKING_TYPE_GET_SUCESS"	=> "Packing Type Detail Get Successfully.",
		"PACKING_TYPE_GET_FAILED"	=> "Packing Type Detail Get Failed.",
		"PACKING_TYPE_STATUS_SUCESS" => "Packing Type Status Update Successfully.",
		"PACKING_TYPE_STATUS_FAILED" => "Packing Type Status Update Failed.",

		//Store Master
		"STORE_INSERT_SUCESS" => "Store Insert Successfully.",
		"STORE_INSERT_FAILED" => "Store Insert Failed.",
		"STORE_UPDATE_SUCESS" => "Store Update Successfully.",
		"STORE_UPDATE_FAILED" => "Store Update Failed.",
		"STORE_DELETE_SUCESS" => "Store Delete Successfully.",
		"STORE_DELETE_FAILED" => "Store Delete Failed.",
		"STORE_GET_SUCESS"	 => "Store Detail Get Successfully.",
		"STORE_GET_FAILED"	 => "Store Detail Get Failed.",
		"STORE_STATUS_SUCESS" => "Store Status Update Successfully.",
		"STORE_STATUS_FAILED" => "Store Status Update Failed.",

		//Vehical Master
		"VEHICAL_INSERT_SUCESS" => "Vehical Insert Successfully.",
		"VEHICAL_INSERT_FAILED" => "Vehical Insert Failed.",
		"VEHICAL_UPDATE_SUCESS" => "Vehical Update Successfully.",
		"VEHICAL_UPDATE_FAILED" => "Vehical Update Failed.",
		"VEHICAL_DELETE_SUCESS" => "Vehical Delete Successfully.",
		"VEHICAL_DELETE_FAILED" => "Vehical Delete Failed.",
		"VEHICAL_GET_SUCESS"	 => "Vehical Detail Get Successfully.",
		"VEHICAL_GET_FAILED"	 => "Vehical Detail Get Failed.",
		"VEHICAL_STATUS_SUCESS" => "Vehical Status Update Successfully.",
		"VEHICAL_STATUS_FAILED" => "Vehical Status Update Failed.",

		//Issue Ticket Type Master
		"ISSUE_TYPE_INSERT_SUCESS" => "Ticket Issue Type Insert Successfully.",
		"ISSUE_TYPE_INSERT_FAILED" => "Ticket Issue Type Insert Failed.",
		"ISSUE_TYPE_UPDATE_SUCESS" => "Ticket Issue Type Update Successfully.",
		"ISSUE_TYPE_UPDATE_FAILED" => "Ticket Issue Type Update Failed.",
		"ISSUE_TYPE_DELETE_SUCESS" => "Ticket Issue Type Delete Successfully.",
		"ISSUE_TYPE_DELETE_FAILED" => "Ticket Issue Type Delete Failed.",
		"ISSUE_TYPE_GET_SUCESS"	  => "Ticket Issue Type Detail Get Successfully.",
		"ISSUE_TYPE_GET_FAILED"	  => "Ticket Issue Type Detail Get Failed.",
		"ISSUE_TYPE_STATUS_SUCESS" => "Ticket Issue Type Status Update Successfully.",
		"ISSUE_TYPE_STATUS_FAILED" => "Ticket Issue Type Status Update Failed.",

		//Vendor 
		"VENDOR_INSERT" => " Vendor Added",
		"VENDOR_UPDATE" => " Vendor Updated",
		"VENDOR_DELETE" => " Vendor Deleted",
		"VENDOR_DELETE_FAILED" => " Vendor Deleted Failed",

		// MANUFACTURE

		"MANUFACTURE_INSERT" => "Manufacture Added",
		"MANUFACTURE_UPDATE" => " Manufacture Updated",
		"MANUFACTURE_DELETE" => " Manufacture Deleted",
		"MANUFACTURE_DELETE_FAILED" => " Manufacture Deleted Failed",

		//Orders 
		"ORDER_INSERT" => "Order Added Successfully!!",
		"ORDER_UPDATE" => "Order Updated Successfully!!",
		"ORDER_DELETE" => "Order Deleted Successfully!!",
		"ORDER_ACTIVE" => "Order Status Update Successfully!!",


		"ORDERS_INSERT" => " Order Added",
		"ORDERS_INSERT_FAILED" => "Order Detail Added Failed.",
		"ORDERS_CREDIT_NOT_ENOUGH" => "Your Credit Limit Not Enough.",
		"ORDERS_UPDATE" => " Order Updated",
		"ORDERS_DELETE" => " Order Deleted",

		//Return 
		"RETURN_INSERT" => "Return Successfully Added",
		"RETURN_INSERT_FAILED" => "Return Detail Added Failed.",
		"RETURN_UPDATE" => " Successfully Order Updated",
		"RETURN_DELETE" => " Successfully Return Deleted",

		"PURCHASE_ORDER_INSERT" => " Purchase Order Added",
		"PURCHASE_ORDER_UPDATE" => " Purchase Order Updated",
		"PURCHASE_ORDER_DELETE" => " Purchase Order Deleted",

		//Employee
		"EMP_PERSONAL_INFO_INSERT" => " Employee Added",
		"EMP_PERSONAL_INFO_UPDATE" => " Employee Updated",
		"EMP_PERSONAL_INFO_DELETE" => " Employee Deleted",
		"EMP_PERSONAL_INFO_DELETE_FAILED" => " Employee Deleted failed",

		"EMP_COMPANY_INFO_INSERT" => " Employee Company Information Added",
		"EMP_COMPANY_INFO_UPDATE" => " Employee Company Information Updated",
		"EMP_COMPANY_INFO_DELETE" => " Employee Company Information Deleted",

		"EMP_SALARY_INFO_INSERT" => " Employee Salary Added",
		"EMP_SALARY_INFO_UPDATE" => " Employee Salary Updated",
		"EMP_SALARY_INFO_DELETE" => " Employee Salary Deleted",

		/*-------------------- Service messages -----------------------*/
		//Update Profile
		"USER_PROFILE_UPDATE_SUCESS" => "Profile Update successfully.",
		"USER_PROFILE_UPDATE_FAILED" => "Profile Update Failed.",
		"DUPLICATE_EMAIL_FOUND" => "Already Exist this Email! Please Try to Another EmailId.",

		"INVALID_API_SERVICE" => "Internal error!!",
		"PARAMETER_MISSING_SERVICE" => "Internal error!!Parameter Missing.",
		"PARAMETER_NOT_VALID_SERVICE" => "Service Parameter missing or not valid!!",
		"INTERNAL_ERROR_SERVICE" => "Database error!!",

		//notification
		"NOTIFICATION_SEND_SUCESS" => "Notification Send Successfully!!",
		"NOTIFICATION_GET_SUCESS" => "Successfully Get notification !!",
		"NOTIFICATION_GET_FAILED" => "No notification Found !!",
		"NOTIFICATION_DELETE_SUCCESS" => "Notification Delete Successfully !!",
		"NOTIFICATION_DELETE_FAILED" => "Notification Delete Failed !!",

		//Get active app
		"ACTIVE_APP_GET_SUCESS" => "Active App Information Get Successfully!!",
		"ACTIVE_APP_GET_FAILED" => "No Data Avalaible!!",


		//get all state
		"STATE_DETAIL_SUCESS" => "State detail found.",

		//get all CITY
		"CITY_DETAIL_SUCESS" => "City detail found.",

		//get service orders & cancel order
		"SERVICE_ORDER_ITEM_GET_SUCESS" => "Successfully Get Orders !!",
		"SERVICE_ORDER_CANCEL_SUCESS" => "Successfully Cancel Orders !!",
		"SERVICE_ORDER_ITEM_GET_FAILED" => "Order Item Not Available!!",
		"SERVICE_ORDER_GET_FAILED" => "Order Not Available!!",

		//PAYMENT 
		"OTP_SEND_SUCESS" => "OTP Send Successfully!!",
		"OTP_SEND_FAILED" => "OTP Send Failed!!",


		//LOGIN DEALER
		"CUSTOMER_LOGIN_SUCESS" => "Customer Login Successfully.",
		"CUSTOMER_LOGIN_FAILED" => "Email OR Password not match.",
		"CUSTOMER_LOGIN_NOT_REGISTERED" => "Email not registered.",
		"CUSTOMER_LOGIN_NOT_VALID" => "Invalid details.",
		"CUSTOMER_LOGIN_NOT_FOUND" => "Internal Error!!.",

		//VERIFY OTP
		"DEALER_VERIFY_OTP_SUCESS" => "OTP Verified Successfully",
		"DEALER_VERIFY_OTP_FAILED" => "OTP Not Match!!",

		//view dealer profile
		"DEALER_DETAIL_SUCESS" => "Dealer Profile Detail Get Successfully.",
		"DEALER_DETAIL_FAILED" => "No Dealer Found!!!",

		//VIEW ISSUE TICKET OF DEALER
		"ISSUE_TICKET_DETAIL_SUCESS" => "Issue Ticket Detail Get Successfully.",
		"ISSUE_TICKET_DETAIL_FAILED" => "Issue Ticket Detail Get Failed.",


		//add issue ticket 
		"ISSUE_TICKET_INSERT_SUCESS_SERVICE" => "Issue Ticket Add Successfully.",


		//TYPE OF ISSUE
		"TYPE_ISSUE_TICKET_DETAIL_SUCESS" => "Type of Issue Ticket Get Successfully.",
		"TYPE_ISSUE_TICKET_DETAIL_FAILED" => "No Ticket Found.",

		//get Product
		"PRODUCT_DETAIL_SUCESS" => "Successfully fetched product!!",

		//get Order List
		"ORDERS_LIST_GET_SUCESS" => "Successfully Get Orders !!",
		"ORDERS_LIST_GET_FAILED" => "Order Get Failed.",
		// Dispatch Get

		"NO_ORDER_FOUND" => "No Order Found.",
		"NO_DISPATCH_FOUND" => "No Dispatch Found.",
		"DISPATCH_GET_SUCESS" => "Dispatch get Succsess",

		//sales executive 
		"SERVICE_SALES_EXECUTIVE_GET_SUCESS" => "Success! Sales Executive Fetched Successfully.",

		//add dealer payment
		"EMPLOYEE_PAYMENT_ADD_SUCESS" => "Employee Payment Added Successfully.",
		"EMPLOYEE_PAYMENT_ADD_FAILED" => "Employee Payment Added Failed!!",

		//get Dealer payment List
		"DEALER_PAYMENT_LIST_GET_SUCESS" => "Dealer Payment Get Successfully.",
		"DEALER_PAYMENT_LIST_GET_FAILED" => "Dealer Payment Get Failed.",
		"NO_DEALER_FOUND" => "Dealer Not Found.",

		//get Dispatch Note
		"DISPATCH_NOTE_GET_SUCESS" => "Dispatch Note Get Successfully.",
		"DDISPATCH_NOTE_GET_FAILED" => "Dispatch Note Get Failed.",

		//claimed offer
		"CLAIMED_OFFER_GET_SUCESS" => "Successfully Get Claimed Offer!!",
		"CLAIMED_OFFER_GET_FAILED" => "Claimed Offer not Found !!",
		"CLAIMED_OFFER_SUCESS" => "Offer Claimed",
		"CLAIMED_OFFER_DEALER_FAILED" => "No dealer found for this dealer",
		"CLAIMED_OFFER_EXPIRED" => "No offer expire today",

		//customer account detail
		"CUSTOMER_ACCOUNT_GET_SUCESS" => "Customer Account Detail Fetch Successfully!!.",
		"CUSTOMER_ACCOUNT_GET_FAILED" => "Customer Account detail not available.",
		"CUSTOMER_NOT_AVAILABLE" => "Customer Not Available.",

		//Delete order
		"DELETE_ORDER_SUCESS" => "Success! Order delete Successfully!!",
		"DELETE_ORDER_FAILED" => "Order can not deleted.",
		"DELETE_DISPATCH_ORDER_ITEM_FAILED" => "Order Item can not deleted!! Order Item Dispatched.",
		"DELETE_ORDER_DETAIL_FAILED" => "Sorry! Order Delete Failed !! Please Try Again Later!!",

		//Delete order item
		"DELETE_ORDER_ITEM_SUCESS" => "Success! Order delete Successfully!!",
		"DELETE_ORDER_ITEM_FAILED" => "Order Item can not deleted.",

		//add to cart
		"ADD_CART_QTY_UPDATED_SUCESS" => "Product already in cart quantity updated!!",
		"ADD_CART_QTY_UPDATED_FAILED" => "Product can't added to cart internal error!!",
		"ADD_CART_PRODUCT_SUCESS" => "Product added to cart!!",
		"ADD_CART_PRODUCT_FAILED" => "Product can't added to cart internal error!!",
		"ADD_CART_REMOVE_PRODUCT" => "Product is removed!!",
		"ADD_CART_QTY_NOT_AVAILABLE" => "Required Qty. Not Available in Stock ",

		"PRODUCT_NOT_AVAILABLE" => "Product Not Found!!",
		"USER_NOT_AVAILABLE" => "User Not Found!!",

		//remove cart item
		"REMOVE_CART_ITEM_SUCCESS" => "Item Successfully Removed From Cart!!",
		"REMOVE_CART_ITEM_FAILED" => "Cart Item Can't Remove Try Later!!!",
		"CART_ITEM_NOT_AVAILABLE" => "Cart Item Not Found!!",

		//UPDATE CART Item
		"UPDATE_CART_ITEM_SUCCESS" => "Cart Items Updated!!",
		"UPDATE_CART_ITEM_FAILED" => "Cart Detail Not Updated!!",
		"CART_ID_NOT_AVAILABLE" => "Cart Id Not Found!!",

		//employee
		"EMPLOYEE_DETAIL_SUCESS" => "Successfully Fetched Employee!!",
		"EMPLOYEE_DETAIL_NOT_FOUND" => "Employee Detail Not Found!!",

		//Credit Note File detail
		"CREDIT_NOTE_GANERATED_SUCCESS" => "Credit Note Detail Fetch Successfully!!.",
		"CREDIT_NOTE_GANERATED_FAILED" => "Credit Note detail not available.",

		//Get Cart Detail 
		"CART_DETAIL_GET_SUCCESS" => "Successfully Get Cart Details !!",
		"CART_DETAIL_GET_FAILED" => "Cart Details Get Failed.",

		"INVOICE_SUBMIT_SUCCESS" => "Invoice Generated",
		"INVOICE_SUBMIT_FAIL" => "Invoice Failed.",

	);
	public $ackMessage = array(

		"INVALID_API_SERVICE" => "Internal error!!",
		"PARAMETER_MISSING_SERVICE" => "Internal error!!Parameter Missing.",
		"PARAMETER_NOT_VALID_SERVICE" => "Service Parameter missing or not valid!!",
		"INTERNAL_ERROR_SERVICE" => "Database error!!",
		//Send Mail
		"SEND_MAIL_SUCESS" => "Check Your Mail For Security Code!!",
		"SEND_MAIL_FAILED" => "Sorry We Can't Proceed Right Now Try Later!!",
		"USER_LOGIN_FAILED" => "User Login Failed.",
		"USER_NOT_FOUND" => "Given User Not Exists!",

		//Change Password
		"PASS_CHANGE_SUCESS" => "Password Update successfully!!",
		"PASS_CHANGE_FAILED" => "Password Update Failed!!",
		"PASSWORD_INCORRECT" => "Password Incorrect please Try Again Later!!",

		//Update Profile
		"USER_PROFILE_UPDATE_SUCESS" => "Profile Update successfully.",
		"USER_PROFILE_UPDATE_FAILED" => "Profile Update Failed.",
		"DUPLICATE_EMAIL_FOUND" => "Already Exist this Email! Please Try to Another EmailId.",

		//Update Profile
		"EMPLOYEE_PROFILE_UPDATE_SUCESS" => "Profile Update successfully.",
		"EMPLOYEE_PROFILE_UPDATE_FAILED" => "Profile Update Failed.",
		"DUPLICATE_EMAIL_FOUND" => "Already Exist this Email! Please Try to Another EmailId.",
		"DUPLICATE_MOBILE_FOUND" => "Already Exist this Mobile Number! Please Try to Another Mobile Number.",


		//user 
		"USER_INSERT_SUCESS" => " User Insert Successfully.",
		"USER_INSERT_FAILED" => " User Insert Failed.",
		"USER_UPDATE_SUCESS" => " User Update Successfully.",
		"USER_UPDATE_FAILED" => " User Update Failed.",
		"USER_DELETE_SUCESS" => " User Deleted",
		"USER_DELETE_FAILED" => " User Deleted Failed",
		"USER_GET_SUCESS"	  => "User Detail Get Successfully.",
		"USER_GET_FAILED"	  => "User Detail Get Failed.",
		"USER_STATUS_SUCESS"	  => "User Status Updated Successfully.",
		"USER_STATUS_FAILED"	  => "User Status Updated Successfully.",



		//Customer 
		"CUSTOMER_INSERT_SUCESS" => "Customer Inserted Successfully.",
		"CUSTOMER_INSERT_FAILED" => "Failed! Customer not Inserted.",
		"CUSTOMER_UPDATE_SUCESS" => "Customer Updated Successfully.",
		"CUSTOMER_UPDATE_FAILED" => "Customer Update Failed.",
		"CUSTOMER_GET_SUCCESS" => "Success! Update Customer Successfully.",
		"CUSTOMER_STATUS_SUCESS" => "Customer Status Updated Successfully.",
		"CUSTOMER_STATUS_FAILED" => "Customer Status Updated Failed.",
		"CUSTOMER_DELETE" => "Customer Deleted Successfully.",
		"CUSTOMER_DELETE_FAILED" => "Customer Deleted Failed.",
		"CUSTOMER_CART_NOT_FOUND" => "Customer Cart Not Found.",
		"CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST" => "Product Not Available For This Branch.",
		"CUSTOMER_NOT_FOUND" => "Customer not found",
		"CART_BRANCH_UPDATED" => "Branch updated successfully",
		"CART_UPDATED" => "Cart updated successfully",
		"VENDOR_APPROVED" => "Vendor Approved Successfully.",
		"VENDOR_APPROVED_FAILED" => "Vendor Approved Failed.",
		"STATUS_CHANGE" => "Status Change Successfully.",
		"STATUS_CHANGE_FAILED" => "Status Change Failed.",
		"RETURN_FOUND" => "Return found",
		"RETURN_NOT_FOUND" => "Return Not found",
		"RETURN_DETAIL_FOUND" => "Return Detail Found",



		//Movie Language 
		"MOVIE_LANGUAGE_INSERT_SUCESS" => "Movie Language  Inserted Successfully.",
		"MOVIE_LANGUAGE_INSERT_FAILED" => "Failed! Movie Language  not Inserted.",
		"MOVIE_LANGUAGE_UPDATE_SUCESS" => "Movie Language  Updated Successfully.",
		"MOVIE_LANGUAGE_UPDATE_FAILED" => "Movie Language  Update Failed.",
		"MOVIE_LANGUAGE_GET_SUCCESS" => "Success! Update Movie Language  Successfully.",
		"MOVIE_LANGUAGE_GET_FAILED" => "Failed! Update Movie Language  Successfully.",
		"MOVIE_LANGUAGE_STATUS_SUCESS" => "Movie Language  Status Updated Successfully.",
		"MOVIE_LANGUAGE_STATUS_FAILED" => "Movie Language  Status Updated Failed.",
		"MOVIE_LANGUAGE_DELETE" => "Movie Language  Deleted Successfully.",
		"MOVIE_LANGUAGE_DELETE_FAILED" => "Movie Language  Deleted Failed.",

		//Food & Beverage Category
		"FBCATEGORY_INSERT_SUCESS" => "Food & Beverage Category Inserted Successfully.",
		"FBCATEGORY_INSERT_FAILED" => "Failed! Food & Beverage Category not Inserted.",
		"FBCATEGORY_UPDATE_SUCESS" => "Food & Beverage Category  Updated Successfully.",
		"FBCATEGORY_UPDATE_FAILED" => "Food & Beverage Category Update Failed.",
		"FBCATEGORY_GET_SUCCESS" => "Success! Update Food & Beverage Category Successfully.",
		"FBCATEGORY_GET_FAILED" => "Failed! Update Food & Beverage Category  Successfully.",
		"FBCATEGORY_STATUS_SUCESS" => "Food & Beverage Category Status Updated Successfully.",
		"FBCATEGORY_STATUS_FAILED" => "Food & Beverage Category Status Updated Failed.",
		"FBCATEGORY_DELETE" => "Food & Beverage Category  Deleted Successfully.",
		"FBCATEGORY_DELETE_FAILED" => "Food & Beverage Category  Deleted Failed.",

		//Food Category
		"FOOD_INSERT_SUCESS" => "Food Category Inserted Successfully.",
		"FOOD_INSERT_FAILED" => "Failed! Food Category not Inserted.",
		"FOOD_UPDATE_SUCESS" => "Food Category  Updated Successfully.",
		"FOOD_UPDATE_FAILED" => "Food Category Update Failed.",
		"FOOD_GET_SUCCESS" => "Success! Update Food Category Successfully.",
		"FOOD_GET_FAILED" => "Failed! Update Food Category  Successfully.",
		"FOOD_STATUS_SUCESS" => "Food Category Status Updated Successfully.",
		"FOOD_STATUS_FAILED" => "Food Category Status Updated Failed.",
		"FOOD_DELETE" => "Food Category  Deleted Successfully.",
		"FOOD_DELETE_FAILED" => "Food Category  Deleted Failed.",




		//Vendor
		"VENDOR_INSERT" => "Vendor Inserted Successfully.",
		"VENDOR_INSERT_FAILED" => "Failed! Vendor not Inserted.",
		"VENDOR_UPDATE" => "Vendor Updated Successfully.",
		"VENDOR_UPDATE_FAILED" => "Vendor Update Failed.",
		"VENDOR_GET_SUCCESS" => "Success! Update Vendor Successfully.",
		"VENDOR_STATUS_SUCESS" => "Vendor Status Updated Successfully.",
		"VENDOR_STATUS_FAILED" => "Vendor Status Updated Failed.",
		"VENDOR_DELETE" => "Vendor Deleted Successfully.",
		"VENDOR_DELETE_FAILED" => "Vendor Deleted Failed.",
		//Quotation
		"QUOTATION_INSERT_SUCESS" => "Quotation Inserted Successfully.",
		"QUOTATION_INSERT_FAILED" => "Failed! Quotation not Inserted.",
		//loan

		"LOAN_INSERT_SUCESS" => "Loan Inserted Successfully.",
		"LOAN_INSERT_FAILED" => "Failed! Loan not Inserted.",
		"LOAN_UPDATE_SUCESS" => "Loan Updated Successfully.",
		"LOAN_UPDATE_FAILED" => "Loan Update Failed.",
		"LOAN_GET_SUCCESS" => "Success! Update Loan Successfully.",
		"LOAN_STATUS_SUCESS" => "Loan Status Updated Successfully.",
		"LOAN_STATUS_FAILED" => "Loan Status Updated Failed.",
		"LOAN_DELETE" => "Loan Deleted Successfully.",
		"LOAN_DELETE_FAILED" => "Loan Deleted Failed.",


		//insurance
		"INSURANCE_INSERT_SUCESS" => "Insurance Inserted Successfully.",
		"INSURANCE_INSERT_FAILED" => "Failed! Insurance not Inserted.",
		"INSURANCE_UPDATE_SUCESS" => "Insurance Updated Successfully.",
		"INSURANCE_UPDATE_FAILED" => "Insurance Update Failed.",
		"INSURANCE_GET_SUCCESS" => "Success! Update Insurance Successfully.",
		"INSURANCE_STATUS_SUCESS" => "Insurance Status Updated Successfully.",
		"INSURANCE_STATUS_FAILED" => "Insurance Status Updated Failed.",
		"INSURANCE_DELETE" => "Insurance Deleted Successfully.",
		"INSURANCE_DELETE_FAILED" => "Insurance Deleted Failed.",


		//Employee
		"EMP_PERSONAL_INFO_INSERT" => " Employee Added",
		"EMP_PERSONAL_INFO_UPDATE" => " Employee Updated",
		"EMP_PERSONAL_INFO_DELETE" => " Employee Deleted",
		"EMP_PERSONAL_INFO_DELETE_FAILED" => " Employee Deleted failed",

		"EMP_COMPANY_INFO_INSERT" => " Employee Company Information Added",
		"EMP_COMPANY_INFO_UPDATE" => " Employee Company Information Updated",
		"EMP_COMPANY_INFO_DELETE" => " Employee Company Information Deleted",

		"EMP_SALARY_INFO_INSERT" => " Employee Salary Added",
		"EMP_SALARY_INFO_UPDATE" => " Employee Salary Updated",
		"EMP_SALARY_INFO_DELETE" => " Employee Salary Deleted",

		//notification
		"NOTIFICATION_SEND_SUCESS" => "Notification Send Successfully!!",
		"NOTIFICATION_GET_SUCESS" => "Successfully Get notification !!",
		"NOTIFICATION_GET_FAILED" => "No notification Found !!",
		"NOTIFICATION_DELETE_SUCCESS" => "Notification Delete Successfully !!",
		"NOTIFICATION_DELETE_FAILED" => "Notification Delete Failed !!",

		//Get active app
		"ACTIVE_APP_GET_SUCESS" => "Active App Information Get Successfully!!",
		"ACTIVE_APP_GET_FAILED" => "No Data Avalaible!!",

		//Banner
		"BANNER_INSERT_SUCESS" => "Banner Insert Successfully.",
		"BANNER_INSERT_FAILED" => "Banner Insert Failed.",
		"BANNER_UPDATE_SUCESS" => "Banner Update Successfully.",
		"BANNER_UPDATE_FAILED" => "Banner Update Failed.",
		"BANNER_DELETE_SUCESS" => "Banner Delete Successfully.",
		"BANNER_DELETE_FAILED" => "Banner Delete Failed.",
		"BANNER_GET_SUCESS"   => "Banner Detail Get Successfully.",
		"BANNER_GET_FAILED"   => "Banner Detail Get Failed.",
		"BANNER_STATUS_SUCESS" => "Banner Status Update Successfully.",
		"BANNER_STATUS_FAILED" => "Banner Status Update Failed.",

		//Advertise
		"ADVERTISE_INSERT_SUCESS" => "Advertise Insert Successfully.",
		"ADVERTISE_INSERT_FAILED" => "Advertise Insert Failed.",
		"ADVERTISE_UPDATE_SUCESS" => "Advertise Update Successfully.",
		"ADVERTISE_UPDATE_FAILED" => "Advertise Update Failed.",
		"ADVERTISE_DELETE_SUCESS" => "Advertise Delete Successfully.",
		"ADVERTISE_DELETE_FAILED" => "Advertise Delete Failed.",
		"ADVERTISE_GET_SUCESS"   => "Advertise Detail Get Successfully.",
		"ADVERTISE_GET_FAILED"   => "Advertise Detail Get Failed.",
		"ADVERTISE_STATUS_SUCESS" => "Advertise Status Update Successfully.",
		"ADVERTISE_STATUS_FAILED" => "Advertise Status Update Failed.",



		//Offer
		"OFFERS_INSERT_SUCESS" => "Offer Insert Successfully.",
		"OFFERS_INSERT_FAILED" => "Offer Insert Failed.",
		"OFFERS_UPDATE_SUCESS" => "Offer Update Successfully.",
		"OFFERS_UPDATE_FAILED" => "Offer Update Failed.",
		"OFFERS_DELETE_SUCESS" => "Offer Delete Successfully.",
		"OFFERS_DELETE_FAILED" => "Offer Delete Failed.",
		"OFFERS_GET_SUCESS"   => "Offer Detail Get Successfully.",
		"OFFERS_GET_FAILED"   => "Offer Detail Get Failed.",
		"OFFERS_STATUS_SUCESS" => "Offer Status Update Successfully.",
		"OFFERS_STATUS_FAILED" => "Offer Status Update Failed.",

		//Voucher
		"VOUCHER_INSERT_SUCESS" => "Voucher Insert Successfully.",
		"VOUCHER_INSERT_FAILED" => "Voucher Insert Failed.",
		"VOUCHER_UPDATE_SUCESS" => "Voucher Update Successfully.",
		"VOUCHER_UPDATE_FAILED" => "Voucher Update Failed.",
		"VOUCHER_DELETE_SUCESS" => "Voucher Delete Successfully.",
		"VOUCHER_DELETE_FAILED" => "Voucher Delete Failed.",
		"VOUCHER_GET_SUCESS"   => "Voucher Detail Get Successfully.",
		"VOUCHER_GET_FAILED"   => "Voucher Detail Get Failed.",
		"VOUCHER_STATUS_SUCESS" => "Voucher Status Update Successfully.",
		"VOUCHER_STATUS_FAILED" => "Voucher Status Update Failed.",

		//Booking
		"BOOKING_INSERT_SUCESS" => "Booking Insert Successfully.",
		"BOOKING_INSERT_FAILED" => "Booking Insert Failed.",
		"BOOKING_UPDATE_SUCESS" => "Booking Update Successfully.",
		"BOOKING_UPDATE_FAILED" => "Booking Update Failed.",
		"BOOKING_DELETE_SUCESS" => "Booking Delete Successfully.",
		"BOOKING_DELETE_FAILED" => "Booking Delete Failed.",
		"BOOKING_GET_SUCESS"   => "Booking Detail Get Successfully.",
		"BOOKING_GET_FAILED"   => "Booking Detail Get Failed.",
		"BOOKING_STATUS_SUCESS" => "Booking Status Update Successfully.",
		"BOOKING_STATUS_FAILED" => "Booking Status Update Failed.",


		//Screen
		"SCREEN_INSERT_SUCESS" => "Screen Details Insert Successfully.",
		"SCREEN_INSERT_FAILED" => "Screen Details  Insert Failed.",
		"SCREEN_UPDATE_SUCESS" => "Screen Details  Update Successfully.",
		"SCREEN_UPDATE_FAILED" => "Screen Details  Update Failed.",
		"SCREEN_DELETE_SUCESS" => "Screen Details  Delete Successfully.",
		"SCREEN_DELETE_FAILED" => "Screen Details  Delete Failed.",
		"SCREEN_GET_SUCESS"   => "Screen Details  Detail Get Successfully.",
		"SCREEN_GET_FAILED"   => "Screen Details  Detail Get Failed.",
		"SCREEN_STATUS_SUCESS" => "Screen Details  Status Update Successfully.",
		"SCREEN_STATUS_FAILED" => "Screen Details  Status Update Failed.",


		//Seat
		"SEAT_INSERT_SUCESS" => "Seat Details Insert Successfully.",
		"SEAT_INSERT_FAILED" => "Seat Details  Insert Failed.",
		"SEAT_UPDATE_SUCESS" => "Seat Details  Update Successfully.",
		"SEAT_UPDATE_FAILED" => "Seat Details  Update Failed.",
		"SEAT_DELETE_SUCESS" => "Seat Details  Delete Successfully.",
		"SEAT_DELETE_FAILED" => "Seat Details  Delete Failed.",
		"SEAT_GET_SUCESS"   => "Seat Details  Detail Get Successfully.",
		"SEAT_GET_FAILED"   => "Seat Details  Detail Get Failed.",
		"SEAT_STATUS_SUCESS" => "Seat Details  Status Update Successfully.",
		"SEAT_STATUS_FAILED" => "Seat Details  Status Update Failed.",

		//Shows
		"SHOWS_INSERT_SUCESS" => "Movie Show Insert Successfully.",
		"SHOWS_INSERT_FAILED" => "Movie Show Insert Failed.",
		"SHOWS_UPDATE_SUCESS" => "Movie Show Update Successfully.",
		"SHOWS_UPDATE_FAILED" => "Movie Show Update Failed.",
		"SHOWS_DELETE_SUCESS" => "Movie Show Delete Successfully.",
		"SHOWS_DELETE_FAILED" => "Movie Show Delete Failed.",
		"SHOWS_GET_SUCESS"   => "Movie Show Detail Get Successfully.",
		"SHOWS_GET_FAILED"   => "Movie Show Detail Get Failed.",
		"SHOWS_STATUS_SUCESS" => "Movie Show Status Update Successfully.",
		"SHOWS_STATUS_FAILED" => "Movie Show Status Update Failed.",

		//Orders
		"ORDERS_INSERT_SUCESS" => "Order Insert Successfully.",
		"ORDERS_INSERT_FAILED" => "Order Insert Failed.",
		"ORDERS_UPDATE_SUCESS" => "Order Update Successfully.",
		"ORDERS_UPDATE_FAILED" => "Order Update Failed.",
		"ORDERS_DELETE_SUCESS" => "Order Delete Successfully.",
		"ORDERS_DELETE_FAILED" => "Order Delete Failed.",
		"ORDERS_GET_SUCESS"   => "Order Detail Get Successfully.",
		"ORDERS_GET_FAILED"   => "Order Detail Get Failed.",
		"ORDERS_STATUS_SUCESS" => "Order Status Update Successfully.",
		"ORDERS_STATUS_FAILED" => "Order Status Update Failed.",

		//Order Items
		"ORDERS_ITEMS_INSERT_SUCESS" => "Order Items Insert Successfully.",
		"ORDERS_ITEMS_INSERT_FAILED" => "Order Items Insert Failed.",
		"ORDERS_ITEMS_UPDATE_SUCESS" => "Order Items Update Successfully.",
		"ORDERS_ITEMS_UPDATE_FAILED" => "Order Items Update Failed.",
		"ORDERS_ITEMS_DELETE_SUCESS" => "Order Items Delete Successfully.",
		"ORDERS_ITEMS_DELETE_FAILED" => "Order Items Delete Failed.",
		"ORDERS_ITEMS_GET_SUCESS"   => "Order Items Detail Get Successfully.",
		"ORDERS_ITEMS_GET_FAILED"   => "Order Items Detail Get Failed.",
		"ORDERS_ITEMS_STATUS_SUCESS" => "Order Items Status Update Successfully.",
		"ORDERS_ITEMS_STATUS_FAILED" => "Order Items Status Update Failed.",



		//Alter Image
		"ALT_IMG_INSERT_SUCESS" => "Alter Image Insert Successfully.",
		"ALT_IMG_INSERT_FAILED" => "Alter Image Insert Failed.",
		"ALT_IMG_UPDATE_SUCESS" => "Alter Image Update Successfully.",
		"ALT_IMG_UPDATE_FAILED" => "Alter Image Update Failed.",
		"ALT_IMG_DELETE_SUCESS" => "Alter Image Delete Successfully.",
		"ALT_IMG_DELETE_FAILED" => "Alter Image Delete Failed.",
		"ALT_IMG_GET_SUCESS"   => "Alter Image Detail Get Successfully.",
		"ALT_IMG_GET_FAILED"   => "Alter Image Detail Get Failed.",
		"ALT_IMG_STATUS_SUCESS" => "Alter Image Status Update Successfully.",
		"ALT_IMG_STATUS_FAILED" => "Alter Image Status Update Failed.",


		//Blog
		"BLOG_INSERT_SUCESS" => "Blog Insert Successfully.",
		"BLOG_INSERT_FAILED" => "Blog Insert Failed.",
		"BLOG_UPDATE_SUCESS" => "Blog Update Successfully.",
		"BLOG_UPDATE_FAILED" => "Blog Update Failed.",
		"BLOG_DELETE_SUCESS" => "Blog Delete Successfully.",
		"BLOG_DELETE_FAILED" => "Blog Delete Failed.",
		"BLOG_GET_SUCESS"   => "Blog Detail Get Successfully.",
		"BLOG_GET_FAILED"   => "Blog Detail Get Failed.",
		"BLOG_STATUS_SUCESS" => "Blog Status Update Successfully.",
		"BLOG_STATUS_FAILED" => "Blog Status Update Failed.",

		//Duplicate Record
		"DUPLICATE_RECORED_FOUND" => "Duplication! Already Exist this Name.",

		//Purchase Order
		"PURCHASE_ORDER_INSERT_SUCESS" => "Purchase Order Insert Successfully.",
		"PURCHASE_ORDER_INSERT_FAILED" => "Purchase Order Insert Failed.",
		"PURCHASE_ORDER_UPDATE_SUCESS" => "Purchase Order Update Successfully.",
		"PURCHASE_ORDER_UPDATE_FAILED" => "Purchase Order Update Failed.",
		"PURCHASE_ORDER_DELETE_SUCESS" => "Purchase Order Delete Successfully.",
		"PURCHASE_ORDER_DELETE_FAILED" => "Purchase Order Delete Failed.",
		"PURCHASE_ORDER_GET_SUCESS"   => "Purchase Order Detail Get Successfully.",
		"PURCHASE_ORDER_GET_FAILED"   => "Purchase Order Detail Get Failed.",
		"PURCHASE_ORDER_STATUS_SUCESS" => "Purchase Order Status Update Successfully.",
		"PURCHASE_ORDER_STATUS_FAILED" => "Purchase Order Status Update Failed.",

		//Inward Store
		"INWARD_STORE_INSERT_SUCESS" => "Inward Store Insert Successfully.",
		"INWARD_STORE_INSERT_FAILED" => "Inward Store Insert Failed.",
		"INWARD_STORE_UPDATE_SUCESS" => "Inward Store Update Successfully.",
		"INWARD_STORE_UPDATE_FAILED" => "Inward Store Update Failed.",
		"INWARD_STORE_DELETE_SUCESS" => "Inward Store Delete Successfully.",
		"INWARD_STORE_DELETE_FAILED" => "Inward Store Delete Failed.",
		"INWARD_STORE_GET_SUCESS"   => "Inward Store Detail Get Successfully.",
		"INWARD_STORE_GET_FAILED"   => "Inward Store Detail Get Failed.",
		"INWARD_STORE_STATUS_SUCESS" => "Inward Store Status Update Successfully.",
		"INWARD_STORE_STATUS_FAILED" => "Inward Store Status Update Failed.",

		//Product
		"PRODUCT_INSERT_SUCESS" => "Product Insert Successfully.",
		"PRODUCT_INSERT_FAILED" => "Product Insert Failed.",
		"PRODUCT_UPDATE_SUCESS" => "Product Update Successfully.",
		"PRODUCT_UPDATE_FAILED" => "Product Update Failed.",
		"PRODUCT_DELETE_SUCESS" => "Product Delete Successfully.",
		"PRODUCT_DELETE_FAILED" => "Product Delete Failed.",
		"PRODUCT_GET_SUCESS"   => "Product Detail Get Successfully.",
		"PRODUCT_GET_FAILED"   => "Product Detail Get Failed.",
		"PRODUCT_STATUS_SUCESS" => "Product Status Update Successfully.",
		"PRODUCT_STATUS_FAILED" => "Product Status Update Failed.",


		//Gallery
		"GALLERY_INSERT_SUCESS" => "Gallery Insert Successfully.",
		"GALLERY_INSERT_FAILED" => "Gallery Insert Failed.",
		"GALLERY_UPDATE_SUCESS" => "Gallery Update Successfully.",
		"GALLERY_UPDATE_FAILED" => "Gallery Update Failed.",
		"GALLERY_DELETE_SUCESS" => "Gallery Delete Successfully.",
		"GALLERY_DELETE_FAILED" => "Gallery Delete Failed.",
		"GALLERY_GET_SUCESS"   => "Gallery Detail Get Successfully.",
		"GALLERY_GET_FAILED"   => "Gallery Detail Get Failed.",
		"GALLERY_STATUS_SUCESS" => "Gallery Status Update Successfully.",
		"GALLERY_STATUS_FAILED" => "Gallery Status Update Failed.",


		//Coupon
		"COUPON_INSERT_SUCESS" => "Coupon Insert Successfully.",
		"COUPON_INSERT_FAILED" => "Coupon Insert Failed.",
		"COUPON_UPDATE_SUCESS" => "Coupon Update Successfully.",
		"COUPON_UPDATE_FAILED" => "Coupon Update Failed.",
		"COUPON_DELETE_SUCESS" => "Coupon Delete Successfully.",
		"COUPON_DELETE_FAILED" => "Coupon Delete Failed.",
		"COUPON_GET_SUCESS"   => "Coupon Detail Get Successfully.",
		"COUPON_GET_FAILED"   => "Coupon Detail Get Failed.",
		"COUPON_STATUS_SUCESS" => "Coupon Status Update Successfully.",
		"COUPON_STATUS_FAILED" => "Coupon Status Update Failed.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS" => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED" => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",

		//Sub Category Master
		"SUB_CATEGORY_INSERT_SUCESS" => "Sub Category Insert Successfully.",
		"SUB_CATEGORY_INSERT_FAILED" => "Sub Category Insert Failed.",
		"SUB_CATEGORY_UPDATE_SUCESS" => "Sub Category Update Successfully.",
		"SUB_CATEGORY_UPDATE_FAILED" => "Sub Category Update Failed.",
		"SUB_CATEGORY_DELETE_SUCESS" => "Sub Category Delete Successfully.",
		"SUB_CATEGORY_DELETE_FAILED" => "Sub Category Delete Failed.",
		"SUB_CATEGORY_GET_SUCESS" => "Sub Category Detail Get Successfully.",
		"SUB_CATEGORY_GET_FAILED" => "Sub Category Detail Get Failed.",
		"SUB_CATEGORY_STATUS_SUCESS" => "Sub Category Status Update Successfully.",
		"SUB_CATEGORY_STATUS_FAILED" => "Sub Category Status Update Failed.",



		//Popup Master
		"POPUP_INSERT_SUCESS" => "Popup Insert Successfully.",
		"POPUP_INSERT_FAILED" => "Popup Insert Failed.",
		"POPUP_UPDATE_SUCESS" => "Popup Update Successfully.",
		"POPUP_UPDATE_FAILED" => "Popup Update Failed.",
		"POPUP_DELETE_SUCESS" => "Popup Delete Successfully.",
		"POPUP_DELETE_FAILED" => "Popup Delete Failed.",
		"POPUP_GET_SUCESS"   => "Popup Detail Get Successfully.",
		"POPUP_GET_FAILED"   => "Popup Detail Get Failed.",
		"POPUP_STATUS_SUCESS" => "Popup Status Update Successfully.",
		"POPUP_STATUS_FAILED" => "Popup Status Update Failed.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS"   => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED"   => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",




		//FAQ Master
		"FAQ_INSERT_SUCESS" => "FAQ Insert Successfully.",
		"FAQ_INSERT_FAILED" => "FAQ Insert Failed.",
		"FAQ_UPDATE_SUCESS" => "FAQ Update Successfully.",
		"FAQ_UPDATE_FAILED" => "FAQ Update Failed.",
		"FAQ_DELETE_SUCESS" => "FAQ Delete Successfully.",
		"FAQ_DELETE_FAILED" => "FAQ Delete Failed.",
		"FAQ_GET_SUCESS"   => "FAQ Detail Get Successfully.",
		"FAQ_GET_FAILED"   => "FAQ Detail Get Failed.",
		"FAQ_STATUS_SUCESS" => "FAQ Status Update Successfully.",
		"FAQ_STATUS_FAILED" => "FAQ Status Update Failed.",




		//QUERY Master
		"QUERY_INSERT_SUCESS" => "Query Insert Successfully.",
		"QUERY_INSERT_FAILED" => "Query Insert Failed.",
		"QUERY_UPDATE_SUCESS" => "Query Update Successfully.",
		"QUERY_UPDATE_FAILED" => "Query Update Failed.",
		"QUERY_DELETE_SUCESS" => "Query Delete Successfully.",
		"QUERY_DELETE_FAILED" => "Query Delete Failed.",
		"QUERY_GET_SUCESS"   => "Query Detail Get Successfully.",
		"QUERY_GET_FAILED"   => "Query Detail Get Failed.",
		"QUERY_STATUS_SUCESS" => "Query Status Update Successfully.",
		"QUERY_STATUS_FAILED" => "Query Status Update Failed.",



		//Plan Master
		"PLAN_INSERT_SUCESS" => "Plan Insert Successfully.",
		"PLAN_INSERT_FAILED" => "Plan Insert Failed.",
		"PLAN_UPDATE_SUCESS" => "Plan Update Successfully.",
		"PLAN_UPDATE_FAILED" => "Plan Update Failed.",
		"PLAN_DELETE_SUCESS" => "Plan Delete Successfully.",
		"PLAN_DELETE_FAILED" => "Plan Delete Failed.",
		"PLAN_GET_SUCESS"   => "Plan Detail Get Successfully.",
		"PLAN_GET_FAILED"   => "Plan Detail Get Failed.",
		"PLAN_STATUS_SUCESS" => "Plan Status Update Successfully.",
		"PLAN_STATUS_FAILED" => "Plan Status Update Failed.",



		//Subscription Master
		"SUBSCRIPTION_INSERT_SUCESS" => "Subscription Insert Successfully.",
		"SUBSCRIPTION_INSERT_FAILED" => "Subscription Insert Failed.",
		"SUBSCRIPTION_UPDATE_SUCESS" => "Subscription Update Successfully.",
		"SUBSCRIPTION_UPDATE_FAILED" => "Subscription Update Failed.",
		"SUBSCRIPTION_DELETE_SUCESS" => "Subscription Delete Successfully.",
		"SUBSCRIPTION_DELETE_FAILED" => "Subscription Delete Failed.",
		"SUBSCRIPTION_GET_SUCESS"   => "Subscription Detail Get Successfully.",
		"SUBSCRIPTION_GET_FAILED"   => "Subscription Detail Get Failed.",
		"SUBSCRIPTION_STATUS_SUCESS" => "Subscription Status Update Successfully.",
		"SUBSCRIPTION_STATUS_FAILED" => "Subscription Status Update Failed.",



		//Testimonial
		"TESTIMONIAL_INSERT_SUCESS" => "Testimonial Insert Successfully.",
		"TESTIMONIAL_INSERT_FAILED" => "Testimonial Insert Failed.",
		"TESTIMONIAL_UPDATE_SUCESS" => "Testimonial Update Successfully.",
		"TESTIMONIAL_UPDATE_FAILED" => "Testimonial Update Failed.",
		"TESTIMONIAL_DELETE_SUCESS" => "Testimonial Delete Successfully.",
		"TESTIMONIAL_DELETE_FAILED" => "Testimonial Delete Failed.",
		"TESTIMONIAL_GET_SUCESS"   => "Testimonial Detail Get Successfully.",
		"TESTIMONIAL_GET_FAILED"   => "Testimonial Detail Get Failed.",
		"TESTIMONIAL_STATUS_SUCESS" => "Testimonial Status Update Successfully.",
		"TESTIMONIAL_STATUS_FAILED" => "Testimonial Status Update Failed.",




		//Offer
		"OFFER_INSERT" => "Offer Insert Successfully.",
		"OFFER_UPDATE" => "Offer Update Successfully.",
		"OFFER_DELETE" => "Offer Delete Successfully.",
		"OFFER_GET_SUCESS"   => "Offer Detail Get Successfully.",
		"OFFER_GET_FAILED"   => "Offer Detail Get Failed.",
		"OFFER_NOT_FOUND"   => " Offer Not Available.",

		//City Master
		"CITY_INSERT_SUCESS" => "City Insert Successfully.",
		"CITY_INSERT_FAILED" => "City Insert Failed.",
		"CITY_UPDATE_SUCESS" => "City Update Successfully.",
		"CITY_UPDATE_FAILED" => "City Update Failed.",
		"CITY_DELETE_SUCESS" => "City Delete Successfully.",
		"CITY_DELETE_FAILED" => "City Delete Failed.",
		"CITY_GET_SUCESS"	=> "City Detail Get Successfully.",
		"CITY_GET_FAILED"	=> "City Detail Get Failed.",
		"CITY_STATUS_SUCESS" => "City Status Update Successfully.",
		"CITY_STATUS_FAILED" => "City Status Update Failed.",


		//Review

		"REVIEW_DELETE_SUCESS" => "Review Delete Successfully.",
		"REVIEW_DELETE_FAILED" => "Review Delete Failed.",

		//Quotation

		"QUOTATION_DELETE_SUCESS" => "Quotation Delete Successfully.",
		"QUOTATION_DELETE_FAILED" => "Quotation Delete Failed.",


		//Image
		"IMAGE_INSERT_SUCESS" => "Image Insert Successfully.",
		"IMAGE_INSERT_FAILED" => "Image Insert Failed.",
		"IMAGE_DELETE_SUCESS" => "Image Delete Successfully.",
		"IMAGE_DELETE_FAILED" => "Image Delete Failed.",
		"IMAGE_UPDATE_SUCESS" => "Image Update Successfully.",
		"IMAGE_UPDATE_FAILED" => "Image Update Failed.",


		//Video
		"VIDEO_INSERT_SUCESS" => "Video Insert Successfully.",
		"VIDEO_INSERT_FAILED" => "Video Insert Failed.",
		"VIDEO_DELETE_SUCESS" => "Video Delete Successfully.",
		"VIDEO_DELETE_FAILED" => "Video Delete Failed.",
		"VIDEO_UPDATE_SUCESS" => "Video Update Successfully.",
		"VIDEO_UPDATE_FAILED" => "Video Update Failed.",
		"VIDEO_STATUS_SUCESS" => "Video Status Updated Successfully.",
		"VIDEO_STATUS_FAILED" => "Video Status Updated Failed.",




		//File
		"FILE_INSERT_SUCESS" => "File Insert Successfully.",
		"FILE_INSERT_FAILED" => "File Insert Failed.",
		"FILE_DELETE_SUCESS" => "File Delete Successfully.",
		"FILE_DELETE_FAILED" => "File Delete Failed.",
		"FILE_UPDATE_SUCESS" => "File Update Successfully.",
		"FILE_UPDATE_FAILED" => "File Update Failed.",
		"FILE_STATUS_SUCESS" => "File Status Updated Successfully.",
		"FILE_STATUS_FAILED" => "File Status Updated Failed.",



		//Book
		"BOOK_INSERT_SUCESS" => "Book Insert Successfully.",
		"BOOK_INSERT_FAILED" => "Book Insert Failed.",
		"BOOK_DELETE_SUCESS" => "Book Delete Successfully.",
		"BOOK_DELETE_FAILED" => "Book Delete Failed.",
		"BOOK_UPDATE_SUCESS" => "Book Update Successfully.",
		"BOOK_UPDATE_FAILED" => "Book Update Failed.",
		"BOOK_STATUS_SUCESS" => "Book Status Updated Successfully.",
		"BOOK_STATUS_FAILED" => "Book Status Updated Failed.",

		//Brand Master
		"BRAND_INSERT_SUCESS" => "Brand Insert Successfully.",
		"BRAND_INSERT_FAILED" => "Brand Insert Failed.",
		"BRAND_UPDATE_SUCESS" => "Brand Update Successfully.",
		"BRAND_UPDATE_FAILED" => "Brand Update Failed.",
		"BRAND_DELETE_SUCESS" => "Brand Delete Successfully.",
		"BRAND_DELETE_FAILED" => "Brand Delete Failed.",
		"BRAND_GET_SUCESS"	 => "Brand Detail Get Successfully.",
		"BRAND_GET_FAILED"	 => "Brand Detail Get Failed.",
		"BRAND_STATUS_SUCESS" => "Brand Status Update Successfully.",
		"BRAND_STATUS_FAILED" => "Brand Status Update Failed.",

		//Service Master
		"SERVICE_INSERT_SUCESS" => "Service Insert Successfully.",
		"SERVICE_INSERT_FAILED" => "Service Insert Failed.",
		"SERVICE_UPDATE_SUCESS" => "Service Update Successfully.",
		"SERVICE_UPDATE_FAILED" => "Service Update Failed.",
		"SERVICE_DELETE_SUCESS" => "Service Delete Successfully.",
		"SERVICE_DELETE_FAILED" => "Service Delete Failed.",
		"SERVICE_GET_SUCESS"	 => "Service Detail Get Successfully.",
		"SERVICE_GET_FAILED"	 => "Service Detail Get Failed.",
		"SERVICE_STATUS_SUCESS" => "Service Status Update Successfully.",
		"SERVICE_STATUS_FAILED" => "Service Status Update Failed.",

		//modal Master
		"MODAL_INSERT_SUCESS" => "Modal Insert Successfully.",
		"MODAL_INSERT_FAILED" => "Modal Insert Failed.",
		"MODAL_UPDATE_SUCESS" => "Modal Update Successfully.",
		"MODAL_UPDATE_FAILED" => "Modal Update Failed.",
		"MODAL_DELETE_SUCESS" => "Modal Delete Successfully.",
		"MODAL_DELETE_FAILED" => "Modal Delete Failed.",
		"MODAL_GET_SUCESS"	 => "Modal Detail Get Successfully.",
		"MODAL_GET_FAILED"	 => "Modal Detail Get Failed.",
		"MODAL_STATUS_SUCESS" => "Modal Status Update Successfully.",
		"MODAL_STATUS_FAILED" => "Modal Status Update Failed.",

		//device problem Master
		"DEVICE_PROBLEM_INSERT_SUCESS" => "Device Problem Insert Successfully.",
		"DEVICE_PROBLEM_INSERT_FAILED" => "Device Problem Insert Failed.",
		"DEVICE_PROBLEM_UPDATE_SUCESS" => "Device Problem Update Successfully.",
		"DEVICE_PROBLEM_UPDATE_FAILED" => "Device Problem Update Failed.",
		"DEVICE_PROBLEM_DELETE_SUCESS" => "Device Problem Delete Successfully.",
		"DEVICE_PROBLEM_DELETE_FAILED" => "Device Problem Delete Failed.",
		"DEVICE_PROBLEM_GET_SUCESS"	 => "Device Problem Detail Get Successfully.",
		"DEVICE_PROBLEM_GET_FAILED"	 => "Device Problem Detail Get Failed.",
		"DEVICE_PROBLEM_STATUS_SUCESS" => "Device Problem Status Update Successfully.",
		"DEVICE_PROBLEM_STATUS_FAILED" => "Device Problem Status Update Failed.",

		//Best Sellers Product Master
		"BESTSELLERS_INSERT_SUCESS" => "Best Sellers Product Insert Successfully.",
		"BESTSELLERS_INSERT_FAILED" => "Best Sellers Product Insert Failed.",
		"BESTSELLERS_UPDATE_SUCESS" => "Best Sellers Product Update Successfully.",
		"BESTSELLERS_UPDATE_FAILED" => "Best Sellers Product Update Failed.",
		"BESTSELLERS_DELETE_SUCESS" => "Best Sellers Product Delete Successfully.",
		"BESTSELLERS_DELETE_FAILED" => "Best Sellers Product Delete Failed.",
		"BESTSELLERS_GET_SUCESS"	 => "Best Sellers Product Detail Get Successfully.",
		"BESTSELLERS_GET_FAILED"	 => "Best Sellers Product Detail Get Failed.",
		"BESTSELLERS_STATUS_SUCESS" => "Best Sellers Product Status Update Successfully.",
		"BESTSELLERS_STATUS_FAILED" => "Best Sellers Product Status Update Failed.",


		//Unit Master
		"UNIT_INSERT_SUCESS" => "Unit Insert Successfully.",
		"UNIT_INSERT_FAILED" => "Unit Insert Failed.",
		"UNIT_UPDATE_SUCESS" => "Unit Update Successfully.",
		"UNIT_UPDATE_FAILED" => "Unit Update Failed.",
		"UNIT_DELETE_SUCESS" => "Unit Delete Successfully.",
		"UNIT_DELETE_FAILED" => "Unit Delete Failed.",
		"UNIT_GET_SUCESS"	=> "Unit Detail Get Successfully.",
		"UNIT_GET_FAILED"	=> "Unit Detail Get Failed.",
		"UNIT_STATUS_SUCESS" => "Unit Status Update Successfully.",
		"UNIT_STATUS_FAILED" => "Unit Status Update Failed.",




		//Department
		"DEPARTMENT_INSERT_SUCESS" => "Department Insert Successfully.",
		"DEPARTMENT_INSERT_FAILED" => "Department Insert Failed.",
		"DEPARTMENT_UPDATE_SUCESS" => "Department Update Successfully.",
		"DEPARTMENT_UPDATE_FAILED" => "Department Update Failed.",
		"DEPARTMENT_DELETE_SUCESS" => "Department Delete Successfully.",
		"DEPARTMENT_DELETE_FAILED" => "Department Delete Failed.",
		"DEPARTMENT_GET_SUCESS"	=> "Department Detail Get Successfully.",
		"DEPARTMENT_GET_FAILED"	=> "Department Detail Get Failed.",
		"DEPARTMENT_STATUS_SUCESS" => "Department Status Update Successfully.",
		"DEPARTMENT_STATUS_FAILED" => "Department Status Update Failed.",

		//Department
		"DEPARTMENT_INSERT_SUCESS" => "Department Insert Successfully.",
		"DEPARTMENT_INSERT_FAILED" => "Department Insert Failed.",
		"DEPARTMENT_UPDATE_SUCESS" => "Department Update Successfully.",
		"DEPARTMENT_UPDATE_FAILED" => "Department Update Failed.",
		"DEPARTMENT_DELETE_SUCESS" => "Department Delete Successfully.",
		"DEPARTMENT_DELETE_FAILED" => "Department Delete Failed.",
		"DEPARTMENT_GET_SUCESS"	=> "Department Detail Get Successfully.",
		"DEPARTMENT_GET_FAILED"	=> "Department Detail Get Failed.",
		"DEPARTMENT_STATUS_SUCESS" => "Department Status Update Successfully.",
		"DEPARTMENT_STATUS_FAILED" => "Department Status Update Failed.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS"   => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED"   => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",

		//Popup Master
		"POPUP_INSERT_SUCESS" => "Popup Insert Successfully.",
		"POPUP_INSERT_FAILED" => "Popup Insert Failed.",
		"POPUP_UPDATE_SUCESS" => "Popup Update Successfully.",
		"POPUP_UPDATE_FAILED" => "Popup Update Failed.",
		"POPUP_DELETE_SUCESS" => "Popup Delete Successfully.",
		"POPUP_DELETE_FAILED" => "Popup Delete Failed.",
		"POPUP_GET_SUCESS"   => "Popup Detail Get Successfully.",
		"POPUP_GET_FAILED"   => "Popup Detail Get Failed.",
		"POPUP_STATUS_SUCESS" => "Popup Status Update Successfully.",
		"POPUP_STATUS_FAILED" => "Popup Status Update Failed.",



		//Designation
		"DESIGNATION_INSERT_SUCESS" => "Designation Insert Successfully.",
		"DESIGNATION_INSERT_FAILED" => "Designation Insert Failed.",
		"DESIGNATION_UPDATE_SUCESS" => "Designation Update Successfully.",
		"DESIGNATION_UPDATE_FAILED" => "Designation Update Failed.",
		"DESIGNATION_DELETE_SUCESS" => "Designation Delete Successfully.",
		"DESIGNATION_DELETE_FAILED" => "Designation Delete Failed.",
		"DESIGNATION_GET_SUCESS"	=> "Designation Detail Get Successfully.",
		"DESIGNATION_GET_FAILED"	=> "Designation Detail Get Failed.",
		"DESIGNATION_STATUS_SUCESS" => "Designation Status Update Successfully.",
		"DESIGNATION_STATUS_FAILED" => "Designation Status Update Failed.",



		//ID Proof Master
		"IDPROOF_INSERT_SUCESS" => "ID Proof Insert Successfully.",
		"IDPROOF_INSERT_FAILED" => "ID Proof Insert Failed.",
		"IDPROOF_UPDATE_SUCESS" => "ID Proof Update Successfully.",
		"IDPROOF_UPDATE_FAILED" => "ID Proof Update Failed.",
		"IDPROOF_DELETE_SUCESS" => "ID Proof Delete Successfully.",
		"IDPROOF_DELETE_FAILED" => "ID Proof Delete Failed.",
		"IDPROOF_GET_SUCESS"	=> "ID Proof Detail Get Successfully.",
		"IDPROOF_GET_FAILED"	=> "ID Proof Detail Get Failed.",
		"IDPROOF_STATUS_SUCESS" => "ID Proof Status Update Successfully.",
		"IDPROOF_STATUS_FAILED" => "ID Proof Status Update Failed.",

		//packing type Master
		"PACKING_TYPE_INSERT_SUCESS" => "Packing Type Insert Successfully.",
		"PACKING_TYPE_INSERT_FAILED" => "Packing Type Insert Failed.",
		"PACKING_TYPE_UPDATE_SUCESS" => "Packing Type Update Successfully.",
		"PACKING_TYPE_UPDATE_FAILED" => "Packing Type Update Failed.",
		"PACKING_TYPE_DELETE_SUCESS" => "Packing Type Delete Successfully.",
		"PACKING_TYPE_DELETE_FAILED" => "Packing Type Delete Failed.",
		"PACKING_TYPE_GET_SUCESS"	=> "Packing Type Detail Get Successfully.",
		"PACKING_TYPE_GET_FAILED"	=> "Packing Type Detail Get Failed.",
		"PACKING_TYPE_STATUS_SUCESS" => "Packing Type Status Update Successfully.",
		"PACKING_TYPE_STATUS_FAILED" => "Packing Type Status Update Failed.",

		//Store Master
		"STORE_INSERT_SUCESS" => "Store Insert Successfully.",
		"STORE_INSERT_FAILED" => "Store Insert Failed.",
		"STORE_UPDATE_SUCESS" => "Store Update Successfully.",
		"STORE_UPDATE_FAILED" => "Store Update Failed.",
		"STORE_DELETE_SUCESS" => "Store Delete Successfully.",
		"STORE_DELETE_FAILED" => "Store Delete Failed.",
		"STORE_GET_SUCESS"	 => "Store Detail Get Successfully.",
		"STORE_GET_FAILED"	 => "Store Detail Get Failed.",
		"STORE_STATUS_SUCESS" => "Store Status Update Successfully.",
		"STORE_STATUS_FAILED" => "Store Status Update Failed.",

		//Vehical Master
		"VEHICAL_INSERT_SUCESS" => "Vehical Insert Successfully.",
		"VEHICAL_INSERT_FAILED" => "Vehical Insert Failed.",
		"VEHICAL_UPDATE_SUCESS" => "Vehical Update Successfully.",
		"VEHICAL_UPDATE_FAILED" => "Vehical Update Failed.",
		"VEHICAL_DELETE_SUCESS" => "Vehical Delete Successfully.",
		"VEHICAL_DELETE_FAILED" => "Vehical Delete Failed.",
		"VEHICAL_GET_SUCESS"	 => "Vehical Detail Get Successfully.",
		"VEHICAL_GET_FAILED"	 => "Vehical Detail Get Failed.",
		"VEHICAL_STATUS_SUCESS" => "Vehical Status Update Successfully.",
		"VEHICAL_STATUS_FAILED" => "Vehical Status Update Failed.",

		//Return 
		"RETURN_INSERT" => "Return Successfully Added",
		"RETURN_INSERT_FAILED" => "Return Detail Added Failed.",
		"RETURN_UPDATE" => " Successfully Order Updated",
		"RETURN_DELETE" => " Successfully Return Deleted",

		//Issue Ticket Type Master
		"ISSUE_TYPE_INSERT_SUCESS" => "Ticket Issue Type Insert Successfully.",
		"ISSUE_TYPE_INSERT_FAILED" => "Ticket Issue Type Insert Failed.",
		"ISSUE_TYPE_UPDATE_SUCESS" => "Ticket Issue Type Update Successfully.",
		"ISSUE_TYPE_UPDATE_FAILED" => "Ticket Issue Type Update Failed.",
		"ISSUE_TYPE_DELETE_SUCESS" => "Ticket Issue Type Delete Successfully.",
		"ISSUE_TYPE_DELETE_FAILED" => "Ticket Issue Type Delete Failed.",
		"ISSUE_TYPE_GET_SUCESS"	  => "Ticket Issue Type Detail Get Successfully.",
		"ISSUE_TYPE_GET_FAILED"	  => "Ticket Issue Type Detail Get Failed.",
		"ISSUE_TYPE_STATUS_SUCESS" => "Ticket Issue Type Status Update Successfully.",
		"ISSUE_TYPE_STATUS_FAILED" => "Ticket Issue Type Status Update Failed.",

		"VENDOR_INSERT" => " Vendor Added",
		"VENDOR_UPDATE" => " Vendor Updated",
		"VENDOR_DELETE" => " Vendor Deleted",
		"VENDOR_DELETE_FAILED" => " Vendor Deleted Failed",

		"MANUFACTURE_INSERT" => "Manufacture Added",
		"MANUFACTURE_UPDATE" => " Manufacture Updated",
		"MANUFACTURE_DELETE" => " Manufacture Deleted",
		"MANUFACTURE_DELETE_FAILED" => " Manufacture Deleted Failed",


		"ORDER_INSERT" => "Order Added Successfully!!",
		"ORDER_UPDATE" => "Order Updated Successfully!!",
		"ORDER_DELETE" => "Order Deleted Successfully!!",
		"ORDER_ACTIVE" => "Order Status Update Successfully!!",


		"STORE_MASTER_INSERT" => "Store Added Successfully!!",
		"STORE_MASTER_UPDATE" => "Store Updated Successfully!!",
		"STORE_MASTER_DELETE" => "Store Deleted Successfully!!",

		"ORDERS_INSERT" => " Order Added Successfully!!",
		"ORDERS_INSERT_FAILED" => "Order Detail Added Failed.",
		"ORDERS_CREDIT_NOT_ENOUGH" => "Your Credit Limit Not Enough.",
		"ORDERS_UPDATE" => " Order Updated Successfully!!",
		"ORDERS_DELETE" => " Order Deleted Successfully!!",

		"PURCHASE_ORDER_INSERT" => " Purchase Order Added Successfully!!",
		"PURCHASE_ORDER_UPDATE" => " Purchase Order Updated Successfully!!",
		"PURCHASE_ORDER_DELETE" => " Purchase Order Deleted Successfully!!",

		"PURCHASE_INDENT_INSERT" => " Purchase Indent Added Successfully!!",
		"PURCHASE_INDENT_UPDATE" => " Purchase Indent Updated Successfully!!",
		"PURCHASE_INDENT_DELETE" => " Purchase Indent Deleted Successfully!!",

		"MATERIAL_REQUEST_INSERT" => " Material Request Added Successfully!!",
		"MATERIAL_REQUEST_UPDATE" => " Material Request Updated Successfully!!",
		"MATERIAL_REQUEST_DELETE" => " Material Request Deleted Successfully!!",

		"INWARD_STORE_INSERT" => " Inward Stre Added Successfully!!",
		"INWARD_STORE_UPDATE" => " Inward Stre Updated Successfully!!",
		"INWARD_STORE_DELETE" => " Inward Stre Deleted Successfully!!",

		"OUTWARD_STORE_INSERT" => " Outward Store Added Successfully!!",
		"OUTWARD_STORE_UPDATE" => " Outward Store Updated Successfully!!",
		"OUTWARD_STORE_DELETE" => " Outward Store Deleted Successfully!!",


		/*--------------------SERVICE MESSAGE----------------*/

		"INVALID_API_SERVICE" => "Internal error!!",
		"PARAMETER_MISSING_SERVICE" => "Internal error!!",
		"INTERNAL_ERROR_SERVICE" => "Database error!!",
		"PARAMETER_NOT_VALID_SERVICE" => "Service Parameter missing or not valid!!",

		//notification
		"NOTIFICATION_SEND_SUCESS" => "Notification Send Successfully!!",
		"NOTIFICATION_GET_SUCESS" => "Successfully Get notification !!",
		"NOTIFICATION_GET_FAILED" => "No notification Found !!",
		"NOTIFICATION_DELETE_SUCCESS" => "Notification Delete Successfully !!",
		"NOTIFICATION_DELETE_FAILED" => "Notification Delete Failed !!",

		//Get active app
		"ACTIVE_APP_GET_SUCESS" => "Active App Information Get Successfully!!",
		"ACTIVE_APP_GET_FAILED" => "No Data Avalaible!!",


		//get all state
		"STATE_DETAIL_SUCESS" => "State detail found.",

		//get all CITY
		"CITY_DETAIL_SUCESS" => "City detail found.",

		//get service orders & cancel order
		"SERVICE_ORDER_ITEM_GET_SUCESS" => "Successfully Get Orders !!",
		"SERVICE_ORDER_CANCEL_SUCESS" => "Successfully Cancel Orders !!",
		"SERVICE_ORDER_ITEM_GET_FAILED" => "Order Item Not Available!!",
		"SERVICE_ORDER_GET_FAILED" => "Order Not Available!!",

		//sales executive 
		"SERVICE_SALES_EXECUTIVE_GET_SUCESS" => "Success! Sales Executive Fetched Successfully.",

		//PAYMENT 
		"OTP_SEND_SUCESS" => "OTP Send Successfully!!",
		"OTP_SEND_FAILED" => "OTP Send Failed!!",

		//LOGIN DEALER
		"CUSTOMER_LOGIN_SUCESS" => "Customer Login Successfully.",
		"CUSTOMER_LOGIN_FAILED" => "Email OR Password not match.",
		"CUSTOMER_LOGIN_NOT_REGISTERED" => "Email not registered.",
		"CUSTOMER_LOGIN_NOT_VALID" => "Invalid details.",
		"CUSTOMER_LOGIN_NOT_FOUND" => "Internal Error!!.",

		//VERIFY OTP
		"DEALER_VERIFY_OTP_SUCESS" => "OTP Verified Successfully",
		"DEALER_VERIFY_OTP_FAILED" => "OTP Not Match!!",

		//view dealer profile
		"DEALER_DETAIL_SUCESS" => "Dealer Profile Detail Get Successfully.",
		"DEALER_DETAIL_FAILED" => "No Issue Ticket Found!!!",

		//VIEW ISSUE TICKET OF DEALER
		"ISSUE_TICKET_DETAIL_SUCESS" => "Issue Ticket Detail Get Successfully.",
		"ISSUE_TICKET_DETAIL_FAILED" => "Issue Ticket Detail Get Failed.",


		//add issue ticket 
		"ISSUE_TICKET_INSERT_SUCESS_SERVICE" => "Issue Ticket Add Successfully.",


		//TYPE OF ISSUE
		"TYPE_ISSUE_TICKET_DETAIL_SUCESS" => "Type of Issue Ticket Get Successfully.",
		"TYPE_ISSUE_TICKET_DETAIL_FAILED" => "No Ticket Found.",

		//get Product
		"PRODUCT_DETAIL_SUCESS" => "Successfully fetched product!!",

		//employee
		"EMPLOYEE_DETAIL_SUCESS" => "Successfully Fetched Employee!!",
		"EMPLOYEE_DETAIL_NOT_FOUND" => "Employee Detail Not Found!!",

		//get Order List
		"ORDERS_LIST_GET_SUCESS" => "Successfully get Orders.",
		"ORDERS_LIST_GET_FAILED" => "Order Get Failed.",
		"NO_ORDER_FOUND" => "No Order Found.",

		//get Dealer payment List
		"DEALER_PAYMENT_LIST_GET_SUCESS" => "Dealer Payment Get Successfully.",
		"DEALER_PAYMENT_LIST_GET_FAILED" => "Dealer Payment Get Failed.",
		"NO_DEALER_FOUND" => "Dealer Not Found.",

		//add dealer payment
		"EMPLOYEE_PAYMENT_ADD_SUCESS" => "Employee Payment Added Successfully.",
		"EMPLOYEE_PAYMENT_ADD_FAILED" => "Employee Payment Added Failed!!",

		//get Dispatch Note
		"INVOICE_GET_SUCESS" => "Invoice  Get Successfully.",
		"INVOICE_GET_FAILED" => "Invoice  Get Failed.",
		"NO_DISPATCH_FOUND" => "No Dispatch Found",


		//claimed offer
		"CLAIMED_OFFER_GET_SUCESS" => "Successfully Get Claimed Offer!!",
		"CLAIMED_OFFER_GET_FAILED" => "Claimed Offer not Found !!",
		"CLAIMED_OFFER_SUCESS" => "Offer Claimed",
		"CLAIMED_OFFER_DEALER_FAILED" => "No dealer found for this dealer",
		"CLAIMED_OFFER_EXPIRED" => "No offer expire today",

		//Dealer account detail
		"CUSTOMER_ACCOUNT_GET_SUCESS" => "Customer Account Detail Fetch Successfully!!.",
		"CUSTOMER_ACCOUNT_GET_FAILED" => "Customer Account detail not available.",
		"CUSTOMER_NOT_AVAILABLE" => "Customer Not Available.",


		//Delete order
		"DELETE_ORDER_SUCESS" => "Success! Order delete Successfully!!",
		"DELETE_ORDER_FAILED" => "Order can not deleted.",
		"DELETE_DISPATCH_ORDER_ITEM_FAILED" => "Order Item can not deleted!! Order Item Dispatched.",
		"DELETE_ORDER_DETAIL_FAILED" => "Sorry! Order Delete Failed !! Please Try Again Later!!",

		//add to cart
		"ADD_CART_QTY_UPDATED_SUCESS" => "Product already in cart quantity updated!!",
		"ADD_CART_QTY_UPDATED_FAILED" => "Product can't added to cart internal error!!",
		"ADD_CART_PRODUCT_SUCESS" => "Product added to cart!!",
		"ADD_CART_PRODUCT_FAILED" => "Product can't added to cart internal error!!",
		"ADD_CART_REMOVE_PRODUCT" => "Product is removed!!",
		"ADD_CART_QTY_NOT_AVAILABLE" => "Required Qty. Not Available in Stock ",

		"PRODUCT_NOT_AVAILABLE" => "Product Not Found!!",
		"USER_NOT_AVAILABLE" => "User Not Found!!",

		//remove cart item
		"REMOVE_CART_ITEM_SUCCESS" => "Item Successfully Removed From Cart!!",
		"REMOVE_CART_ITEM_FAILED" => "Cart Item Can't Remove Try Later!!!",
		"CART_ITEM_NOT_AVAILABLE" => "Cart Item Not Found!!",

		//remove user
		"USER_REMOVE_SUCESS" => "User Successfully Removed!!",
		"USER_REMOVE_FAILED" => " User Removed Failed!!",


		//UPDATE CART Item
		"UPDATE_CART_ITEM_SUCCESS" => "Cart Items Updated!!",
		"UPDATE_CART_ITEM_FAILED" => "Cart Detail Not Updated!!",
		"CART_ID_NOT_AVAILABLE" => "Cart Id Not Found!!",

		//Order CART detail
		"CART_DETAIL_NOT_FOUND" => "Cart Detail Not Found!!",

		//Get Cart Detail 
		"CART_DETAIL_GET_SUCCESS" => "Successfully Get Cart Details !!",
		"CART_DETAIL_GET_FAILED" => "Cart Details Get Failed.",

		//Credit Note File detail
		"CREDIT_NOTE_GANERATED_SUCCESS" => "Credit Note Detail Fetch Successfully!!.",
		"CREDIT_NOTE_GANERATED_FAILED" => "Credit Note detail not available.",

		//LOGIN employee
		"EMPLOYEE_LOGIN_SUCESS" => "Employee Login Successfully.",
		"EMPLOYEE_LOGIN_FAILED" => "Email OR Password not match.",
		"EMPLOYEE_LOGIN_NOT_REGISTERED" => "Email not registered.",
		"EMPLOYEE_LOGIN_NOT_VALID" => "Invalid details.",
		"EMPLOYEE_LOGIN_NOT_FOUND" => "Internal Error!!.",

		"INVOICE_SUBMIT_SUCCESS" => "Invoice Generated",
		"INVOICE_SUBMIT_FAIL" => "Invoice Failed.",
	);
	public $developerMessage = array(
		//Duplicate Record
		"INVALID_API_SERVICE" => "Unauthorized Access",

		//Return 
		"RETURN_INSERT" => "Return Successfully Added",
		"RETURN_INSERT_FAILED" => "Return Detail Added Failed.",
		"RETURN_UPDATE" => " Successfully Order Updated",
		"RETURN_DELETE" => " Successfully Return Deleted",

		//Duplicate Record
		"DUPLICATE_RECORED_FOUND" => "Duplication! Already Exist this number.",
		//Change Password
		"PASS_CHANGE_SUCESS" => "Password Update successfully!!",
		"PASS_CHANGE_FAILED" => "Password Update Failed!!",
		"PASSWORD_INCORRECT" => "Password Incorrect please Try Again Later!!",

		//Update Profile
		"USER_PROFILE_UPDATE_SUCESS" => "Profile Update successfully.",
		"USER_PROFILE_UPDATE_FAILED" => "Profile Update Failed.",
		"DUPLICATE_EMAIL_FOUND" => "Already Exist this Email! Please Try to Another EmailId.",

		//Update Profile Employee
		"EMPLOYEE_PROFILE_UPDATE_SUCESS" => "Profile Update successfully.",
		"EMPLOYEE_PROFILE_UPDATE_FAILED" => "Profile Update Failed.",
		"DUPLICATE_EMAIL_FOUND" => "Already Exist this Email! Please Try to Another EmailId.",
		"DUPLICATE_MOBILE_FOUND" => "Already Exist this Mobile Number! Please Try to Another Mobile Number.",


		//user 
		"USER_INSERT_SUCESS" => " User Insert Successfully.",
		"USER_INSERT_FAILED" => " User Insert Failed.",
		"USER_UPDATE_SUCESS" => " User Update Successfully.",
		"USER_UPDATE_FAILED" => " User Update Failed.",
		"USER_DELETE_SUCESS" => " User Deleted",
		"USER_DELETE_FAILED" => " User Deleted Failed",
		"USER_GET_SUCESS"	  => "User Detail Get Successfully.",
		"USER_GET_FAILED"	  => "User Detail Get Failed.",
		"USER_STATUS_SUCESS"	  => "User Status Updated Successfully.",
		"USER_STATUS_FAILED"	  => "User Status Updated Successfully.",


		//Customer 
		"CUSTOMER_INSERT_SUCESS" => "Customer Inserted Successfully.",
		"CUSTOMER_INSERT_FAILED" => "Failed! Customer not Inserted.",
		"CUSTOMER_UPDATE_SUCESS" => "Customer Updated Successfully.",
		"CUSTOMER_UPDATE_FAILED" => "Customer Update Failed.",
		"CUSTOMER_GET_SUCCESS" => "Success! Update Customer Successfully.",
		"CUSTOMER_STATUS_SUCESS" => "Customer Status Updated Successfully.",
		"CUSTOMER_STATUS_FAILED" => "Customer Status Updated Failed.",
		"CUSTOMER_DELETE" => "Customer Deleted Successfully.",
		"CUSTOMER_DELETE_FAILED" => "Customer Deleted Failed.",
		"CUSTOMER_CART_NOT_FOUND" => "Customer Cart Not Found.",
		"CUSTOMER_BRANCH_NOT_HAVING_PRICE_LIST" => "Product Not Available For This Branch.",
		"CUSTOMER_NOT_FOUND" => "Customer not found",
		"CART_BRANCH_UPDATED" => "Branch updated successfully",
		"CART_UPDATED" => "Cart updated successfully",
		"VENDOR_APPROVED" => "Vendor Approved Successfully.",
		"VENDOR_APPROVED_FAILED" => "Vendor Approved Failed.",
		"STATUS_CHANGE" => "Status Change Successfully.",
		"STATUS_CHANGE_FAILED" => "Status Change Failed.",
		"RETURN_FOUND" => "Return found",
		"RETURN_NOT_FOUND" => "Return Not found",
		"RETURN_DETAIL_FOUND" => "Return Detail Found",


		//Movie Language 
		"MOVIE_LANGUAGE_INSERT_SUCESS" => "Movie Language  Inserted Successfully.",
		"MOVIE_LANGUAGE_INSERT_FAILED" => "Failed! Movie Language  not Inserted.",
		"MOVIE_LANGUAGE_UPDATE_SUCESS" => "Movie Language  Updated Successfully.",
		"MOVIE_LANGUAGE_UPDATE_FAILED" => "Movie Language  Update Failed.",
		"MOVIE_LANGUAGE_GET_SUCCESS" => "Success! Update Movie Language  Successfully.",
		"MOVIE_LANGUAGE_GET_FAILED" => "Failed! Update Movie Language  Successfully.",
		"MOVIE_LANGUAGE_STATUS_SUCESS" => "Movie Language  Status Updated Successfully.",
		"MOVIE_LANGUAGE_STATUS_FAILED" => "Movie Language  Status Updated Failed.",
		"MOVIE_LANGUAGE_DELETE" => "Movie Language  Deleted Successfully.",
		"MOVIE_LANGUAGE_DELETE_FAILED" => "Movie Language  Deleted Failed.",


		//Food & Beverage Category
		"FBCATEGORY_INSERT_SUCESS" => "Food & Beverage Category Inserted Successfully.",
		"FBCATEGORY_INSERT_FAILED" => "Failed! Food & Beverage Category not Inserted.",
		"FBCATEGORY_UPDATE_SUCESS" => "Food & Beverage Category  Updated Successfully.",
		"FBCATEGORY_UPDATE_FAILED" => "Food & Beverage Category Update Failed.",
		"FBCATEGORY_GET_SUCCESS" => "Success! Update Food & Beverage Category Successfully.",
		"FBCATEGORY_GET_FAILED" => "Failed! Update Food & Beverage Category  Successfully.",
		"FBCATEGORY_STATUS_SUCESS" => "Food & Beverage Category Status Updated Successfully.",
		"FBCATEGORY_STATUS_FAILED" => "Food & Beverage Category Status Updated Failed.",
		"FBCATEGORY_DELETE" => "Food & Beverage Category  Deleted Successfully.",
		"FBCATEGORY_DELETE_FAILED" => "Food & Beverage Category  Deleted Failed.",

		//Food Category
		"FOOD_INSERT_SUCESS" => "Food Category Inserted Successfully.",
		"FOOD_INSERT_FAILED" => "Failed! Food Category not Inserted.",
		"FOOD_UPDATE_SUCESS" => "Food Category  Updated Successfully.",
		"FOOD_UPDATE_FAILED" => "Food Category Update Failed.",
		"FOOD_GET_SUCCESS" => "Success! Update Food Category Successfully.",
		"FOOD_GET_FAILED" => "Failed! Update Food Category  Successfully.",
		"FOOD_STATUS_SUCESS" => "Food Category Status Updated Successfully.",
		"FOOD_STATUS_FAILED" => "Food Category Status Updated Failed.",
		"FOOD_DELETE" => "Food Category  Deleted Successfully.",
		"FOOD_DELETE_FAILED" => "Food Category  Deleted Failed.",



		//Quotation
		"QUOTATION_INSERT_SUCESS" => "Quotation Inserted Successfully.",
		"QUOTATION_INSERT_FAILED" => "Failed! Quotation not Inserted.",

		//loan

		"LOAN_INSERT_SUCESS" => "Loan Inserted Successfully.",
		"LOAN_INSERT_FAILED" => "Failed! Loan not Inserted.",
		"LOAN_UPDATE_SUCESS" => "Loan Updated Successfully.",
		"LOAN_UPDATE_FAILED" => "Loan Update Failed.",
		"LOAN_GET_SUCCESS" => "Success! Update Loan Successfully.",
		"LOAN_STATUS_SUCESS" => "Loan Status Updated Successfully.",
		"LOAN_STATUS_FAILED" => "Loan Status Updated Failed.",
		"LOAN_DELETE" => "Loan Deleted Successfully.",
		"LOAN_DELETE_FAILED" => "Loan Deleted Failed.",


		//insurance
		"INSURANCE_INSERT_SUCESS" => "Insurance Inserted Successfully.",
		"INSURANCE_INSERT_FAILED" => "Failed! Insurance not Inserted.",
		"INSURANCE_UPDATE_SUCESS" => "Insurance Updated Successfully.",
		"INSURANCE_UPDATE_FAILED" => "Insurance Update Failed.",
		"INSURANCE_GET_SUCCESS" => "Success! Update Insurance Successfully.",
		"INSURANCE_STATUS_SUCESS" => "Insurance Status Updated Successfully.",
		"INSURANCE_STATUS_FAILED" => "Insurance Status Updated Failed.",
		"INSURANCE_DELETE" => "Insurance Deleted Successfully.",
		"INSURANCE_DELETE_FAILED" => "Insurance Deleted Failed.",


		//Vendor
		"VENDOR_INSERT" => "Vendor Inserted Successfully.",
		"VENDOR_INSERT_FAILED" => "Failed! Vendor not Inserted.",
		"VENDOR_UPDATE" => "Vendor Updated Successfully.",
		"VENDOR_UPDATE_FAILED" => "Vendor Update Failed.",
		"VENDOR_GET_SUCCESS" => "Success! Update Vendor Successfully.",
		"VENDOR_STATUS_SUCESS" => "Vendor Status Updated Successfully.",
		"VENDOR_STATUS_FAILED" => "Vendor Status Updated Failed.",
		"VENDOR_DELETE" => "Vendor Deleted Successfully.",
		"VENDOR_DELETE_FAILED" => "Vendor Deleted Failed.",

		//Purchase Order
		"PURCHASE_ORDER_INSERT_SUCESS" => "Purchase Order Insert Successfully.",
		"PURCHASE_ORDER_INSERT_FAILED" => "Purchase Order Insert Failed.",
		"PURCHASE_ORDER_UPDATE_SUCESS" => "Purchase Order Update Successfully.",
		"PURCHASE_ORDER_UPDATE_FAILED" => "Purchase Order Update Failed.",
		"PURCHASE_ORDER_DELETE_SUCESS" => "Purchase Order Delete Successfully.",
		"PURCHASE_ORDER_DELETE_FAILED" => "Purchase Order Delete Failed.",
		"PURCHASE_ORDER_GET_SUCESS"   => "Purchase Order Detail Get Successfully.",
		"PURCHASE_ORDER_GET_FAILED"   => "Purchase Order Detail Get Failed.",
		"PURCHASE_ORDER_STATUS_SUCESS" => "Purchase Order Status Update Successfully.",
		"PURCHASE_ORDER_STATUS_FAILED" => "Purchase Order Status Update Failed.",

		//Inward Store
		"INWARD_STORE_INSERT_SUCESS" => "Inward Store Insert Successfully.",
		"INWARD_STORE_INSERT_FAILED" => "Inward Store Insert Failed.",
		"INWARD_STORE_UPDATE_SUCESS" => "Inward Store Update Successfully.",
		"INWARD_STORE_UPDATE_FAILED" => "Inward Store Update Failed.",
		"INWARD_STORE_DELETE_SUCESS" => "Inward Store Delete Successfully.",
		"INWARD_STORE_DELETE_FAILED" => "Inward Store Delete Failed.",
		"INWARD_STORE_GET_SUCESS"   => "Inward Store Detail Get Successfully.",
		"INWARD_STORE_GET_FAILED"   => "Inward Store Detail Get Failed.",
		"INWARD_STORE_STATUS_SUCESS" => "Inward Store Status Update Successfully.",
		"INWARD_STORE_STATUS_FAILED" => "Inward Store Status Update Failed.",

		//Product
		"PRODUCT_INSERT_SUCESS" => "Product Insert Successfully.",
		"PRODUCT_INSERT_FAILED" => "Product Insert Failed.",
		"PRODUCT_UPDATE_SUCESS" => "Product Update Successfully.",
		"PRODUCT_UPDATE_FAILED" => "Product Update Failed.",
		"PRODUCT_DELETE_SUCESS" => "Product Delete Successfully.",
		"PRODUCT_DELETE_FAILED" => "Product Delete Failed.",
		"PRODUCT_GET_SUCESS"   => "Product Detail Get Successfully.",
		"PRODUCT_GET_FAILED"   => "Product Detail Get Failed.",
		"PRODUCT_STATUS_SUCESS" => "Product Status Update Successfully.",
		"PRODUCT_STATUS_FAILED" => "Product Status Update Failed.",

		//Gallery
		"GALLERY_INSERT_SUCESS" => "Gallery Insert Successfully.",
		"GALLERY_INSERT_FAILED" => "Gallery Insert Failed.",
		"GALLERY_UPDATE_SUCESS" => "Gallery Update Successfully.",
		"GALLERY_UPDATE_FAILED" => "Gallery Update Failed.",
		"GALLERY_DELETE_SUCESS" => "Gallery Delete Successfully.",
		"GALLERY_DELETE_FAILED" => "Gallery Delete Failed.",
		"GALLERY_GET_SUCESS"   => "Gallery Detail Get Successfully.",
		"GALLERY_GET_FAILED"   => "Gallery Detail Get Failed.",
		"GALLERY_STATUS_SUCESS" => "Gallery Status Update Successfully.",
		"GALLERY_STATUS_FAILED" => "Gallery Status Update Failed.",

		//Banner
		"BANNER_INSERT_SUCESS" => "Banner Insert Successfully.",
		"BANNER_INSERT_FAILED" => "Banner Insert Failed.",
		"BANNER_UPDATE_SUCESS" => "Banner Update Successfully.",
		"BANNER_UPDATE_FAILED" => "Banner Update Failed.",
		"BANNER_DELETE_SUCESS" => "Banner Delete Successfully.",
		"BANNER_DELETE_FAILED" => "Banner Delete Failed.",
		"BANNER_GET_SUCESS"   => "Banner Detail Get Successfully.",
		"BANNER_GET_FAILED"   => "Banner Detail Get Failed.",
		"BANNER_STATUS_SUCESS" => "Banner Status Update Successfully.",
		"BANNER_STATUS_FAILED" => "Banner Status Update Failed.",
		//Advertise
		"ADVERTISE_INSERT_SUCESS" => "Advertise Insert Successfully.",
		"ADVERTISE_INSERT_FAILED" => "Advertise Insert Failed.",
		"ADVERTISE_UPDATE_SUCESS" => "Advertise Update Successfully.",
		"ADVERTISE_UPDATE_FAILED" => "Advertise Update Failed.",
		"ADVERTISE_DELETE_SUCESS" => "Advertise Delete Successfully.",
		"ADVERTISE_DELETE_FAILED" => "Advertise Delete Failed.",
		"ADVERTISE_GET_SUCESS"   => "Advertise Detail Get Successfully.",
		"ADVERTISE_GET_FAILED"   => "Advertise Detail Get Failed.",
		"ADVERTISE_STATUS_SUCESS" => "Advertise Status Update Successfully.",
		"ADVERTISE_STATUS_FAILED" => "Advertise Status Update Failed.",


		//Offer
		"OFFERS_INSERT_SUCESS" => "Offer Insert Successfully.",
		"OFFERS_INSERT_FAILED" => "Offer Insert Failed.",
		"OFFERS_UPDATE_SUCESS" => "Offer Update Successfully.",
		"OFFERS_UPDATE_FAILED" => "Offer Update Failed.",
		"OFFERS_DELETE_SUCESS" => "Offer Delete Successfully.",
		"OFFERS_DELETE_FAILED" => "Offer Delete Failed.",
		"OFFERS_GET_SUCESS"   => "Offer Detail Get Successfully.",
		"OFFERS_GET_FAILED"   => "Offer Detail Get Failed.",
		"OFFERS_STATUS_SUCESS" => "Offer Status Update Successfully.",
		"OFFERS_STATUS_FAILED" => "Offer Status Update Failed.",



		//Voucher
		"VOUCHER_INSERT_SUCESS" => "Voucher Insert Successfully.",
		"VOUCHER_INSERT_FAILED" => "Voucher Insert Failed.",
		"VOUCHER_UPDATE_SUCESS" => "Voucher Update Successfully.",
		"VOUCHER_UPDATE_FAILED" => "Voucher Update Failed.",
		"VOUCHER_DELETE_SUCESS" => "Voucher Delete Successfully.",
		"VOUCHER_DELETE_FAILED" => "Voucher Delete Failed.",
		"VOUCHER_GET_SUCESS"   => "Voucher Detail Get Successfully.",
		"VOUCHER_GET_FAILED"   => "Voucher Detail Get Failed.",
		"VOUCHER_STATUS_SUCESS" => "Voucher Status Update Successfully.",
		"VOUCHER_STATUS_FAILED" => "Voucher Status Update Failed.",


		//Booking
		"BOOKING_INSERT_SUCESS" => "Booking Insert Successfully.",
		"BOOKING_INSERT_FAILED" => "Booking Insert Failed.",
		"BOOKING_UPDATE_SUCESS" => "Booking Update Successfully.",
		"BOOKING_UPDATE_FAILED" => "Booking Update Failed.",
		"BOOKING_DELETE_SUCESS" => "Booking Delete Successfully.",
		"BOOKING_DELETE_FAILED" => "Booking Delete Failed.",
		"BOOKING_GET_SUCESS"   => "Booking Detail Get Successfully.",
		"BOOKING_GET_FAILED"   => "Booking Detail Get Failed.",
		"BOOKING_STATUS_SUCESS" => "Booking Status Update Successfully.",
		"BOOKING_STATUS_FAILED" => "Booking Status Update Failed.",

		//Screen
		"SCREEN_INSERT_SUCESS" => "Screen Details Insert Successfully.",
		"SCREEN_INSERT_FAILED" => "Screen Details  Insert Failed.",
		"SCREEN_UPDATE_SUCESS" => "Screen Details  Update Successfully.",
		"SCREEN_UPDATE_FAILED" => "Screen Details  Update Failed.",
		"SCREEN_DELETE_SUCESS" => "Screen Details  Delete Successfully.",
		"SCREEN_DELETE_FAILED" => "Screen Details  Delete Failed.",
		"SCREEN_GET_SUCESS"   => "Screen Details  Detail Get Successfully.",
		"SCREEN_GET_FAILED"   => "Screen Details  Detail Get Failed.",
		"SCREEN_STATUS_SUCESS" => "Screen Details  Status Update Successfully.",
		"SCREEN_STATUS_FAILED" => "Screen Details  Status Update Failed.",

		//Seat
		"SEAT_INSERT_SUCESS" => "Seat Details Insert Successfully.",
		"SEAT_INSERT_FAILED" => "Seat Details  Insert Failed.",
		"SEAT_UPDATE_SUCESS" => "Seat Details  Update Successfully.",
		"SEAT_UPDATE_FAILED" => "Seat Details  Update Failed.",
		"SEAT_DELETE_SUCESS" => "Seat Details  Delete Successfully.",
		"SEAT_DELETE_FAILED" => "Seat Details  Delete Failed.",
		"SEAT_GET_SUCESS"   => "Seat Details  Detail Get Successfully.",
		"SEAT_GET_FAILED"   => "Seat Details  Detail Get Failed.",
		"SEAT_STATUS_SUCESS" => "Seat Details  Status Update Successfully.",
		"SEAT_STATUS_FAILED" => "Seat Details  Status Update Failed.",

		//Shows
		"SHOWS_INSERT_SUCESS" => "Movie Show Insert Successfully.",
		"SHOWS_INSERT_FAILED" => "Movie Show Insert Failed.",
		"SHOWS_UPDATE_SUCESS" => "Movie Show Update Successfully.",
		"SHOWS_UPDATE_FAILED" => "Movie Show Update Failed.",
		"SHOWS_DELETE_SUCESS" => "Movie Show Delete Successfully.",
		"SHOWS_DELETE_FAILED" => "Movie Show Delete Failed.",
		"SHOWS_GET_SUCESS"   => "Movie Show Detail Get Successfully.",
		"SHOWS_GET_FAILED"   => "Movie Show Detail Get Failed.",
		"SHOWS_STATUS_SUCESS" => "Movie Show Status Update Successfully.",
		"SHOWS_STATUS_FAILED" => "Movie Show Status Update Failed.",

		//Orders
		"ORDERS_INSERT_SUCESS" => "Order Insert Successfully.",
		"ORDERS_INSERT_FAILED" => "Order Insert Failed.",
		"ORDERS_UPDATE_SUCESS" => "Order Update Successfully.",
		"ORDERS_UPDATE_FAILED" => "Order Update Failed.",
		"ORDERS_DELETE_SUCESS" => "Order Delete Successfully.",
		"ORDERS_DELETE_FAILED" => "Order Delete Failed.",
		"ORDERS_GET_SUCESS"   => "Order Detail Get Successfully.",
		"ORDERS_GET_FAILED"   => "Order Detail Get Failed.",
		"ORDERS_STATUS_SUCESS" => "Order Status Update Successfully.",
		"ORDERS_STATUS_FAILED" => "Order Status Update Failed.",

		//Order Items
		"ORDERS_ITEMS_INSERT_SUCESS" => "Order Items Insert Successfully.",
		"ORDERS_ITEMS_INSERT_FAILED" => "Order Items Insert Failed.",
		"ORDERS_ITEMS_UPDATE_SUCESS" => "Order Items Update Successfully.",
		"ORDERS_ITEMS_UPDATE_FAILED" => "Order Items Update Failed.",
		"ORDERS_ITEMS_DELETE_SUCESS" => "Order Items Delete Successfully.",
		"ORDERS_ITEMS_DELETE_FAILED" => "Order Items Delete Failed.",
		"ORDERS_ITEMS_GET_SUCESS"   => "Order Items Detail Get Successfully.",
		"ORDERS_ITEMS_GET_FAILED"   => "Order Items Detail Get Failed.",
		"ORDERS_ITEMS_STATUS_SUCESS" => "Order Items Status Update Successfully.",
		"ORDERS_ITEMS_STATUS_FAILED" => "Order Items Status Update Failed.",



		//Alter Image
		"ALT_IMG_INSERT_SUCESS" => "Alter Image Insert Successfully.",
		"ALT_IMG_INSERT_FAILED" => "Alter Image Insert Failed.",
		"ALT_IMG_UPDATE_SUCESS" => "Alter Image Update Successfully.",
		"ALT_IMG_UPDATE_FAILED" => "Alter Image Update Failed.",
		"ALT_IMG_DELETE_SUCESS" => "Alter Image Delete Successfully.",
		"ALT_IMG_DELETE_FAILED" => "Alter Image Delete Failed.",
		"ALT_IMG_GET_SUCESS"   => "Alter Image Detail Get Successfully.",
		"ALT_IMG_GET_FAILED"   => "Alter Image Detail Get Failed.",
		"ALT_IMG_STATUS_SUCESS" => "Alter Image Status Update Successfully.",
		"ALT_IMG_STATUS_FAILED" => "Alter Image Status Update Failed.",


		//Blog
		"BLOG_INSERT_SUCESS" => "Blog Insert Successfully.",
		"BLOG_INSERT_FAILED" => "Blog Insert Failed.",
		"BLOG_UPDATE_SUCESS" => "Blog Update Successfully.",
		"BLOG_UPDATE_FAILED" => "Blog Update Failed.",
		"BLOG_DELETE_SUCESS" => "Blog Delete Successfully.",
		"BLOG_DELETE_FAILED" => "Blog Delete Failed.",
		"BLOG_GET_SUCESS"   => "Blog Detail Get Successfully.",
		"BLOG_GET_FAILED"   => "Blog Detail Get Failed.",
		"BLOG_STATUS_SUCESS" => "Blog Status Update Successfully.",
		"BLOG_STATUS_FAILED" => "Blog Status Update Failed.",

		//Coupon
		"COUPON_INSERT_SUCESS" => "Coupon Insert Successfully.",
		"COUPON_INSERT_FAILED" => "Coupon Insert Failed.",
		"COUPON_UPDATE_SUCESS" => "Coupon Update Successfully.",
		"COUPON_UPDATE_FAILED" => "Coupon Update Failed.",
		"COUPON_DELETE_SUCESS" => "Coupon Delete Successfully.",
		"COUPON_DELETE_FAILED" => "Coupon Delete Failed.",
		"COUPON_GET_SUCESS"   => "Coupon Detail Get Successfully.",
		"COUPON_GET_FAILED"   => "Coupon Detail Get Failed.",
		"COUPON_STATUS_SUCESS" => "Coupon Status Update Successfully.",
		"COUPON_STATUS_FAILED" => "Coupon Status Update Failed.",

		//Employee
		"EMP_PERSONAL_INFO_INSERT" => " Employee Added",
		"EMP_PERSONAL_INFO_UPDATE" => " Employee Updated",
		"EMP_PERSONAL_INFO_DELETE" => " Employee Deleted",
		"EMP_PERSONAL_INFO_DELETE_FAILED" => " Employee Deleted failed",

		"EMP_COMPANY_INFO_INSERT" => " Employee Company Information Added",
		"EMP_COMPANY_INFO_UPDATE" => " Employee Company Information Updated",
		"EMP_COMPANY_INFO_DELETE" => " Employee Company Information Deleted",

		"EMP_SALARY_INFO_INSERT" => " Employee Salary Added",
		"EMP_SALARY_INFO_UPDATE" => " Employee Salary Updated",
		"EMP_SALARY_INFO_DELETE" => " Employee Salary Deleted",

		//Offer
		"OFFER_INSERT" => "Offer Insert Successfully.",
		"OFFER_UPDATE" => "Offer Update Successfully.",
		"OFFER_DELETE" => "Offer Delete Successfully.",
		"OFFER_GET_SUCESS"   => "Offer Detail Get Successfully.",
		"OFFER_GET_FAILED"   => "Offer Detail Get Failed.",
		"OFFER_NOT_FOUND"   => " Offer Not Available.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS" => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED" => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",


		//Sub Category Master
		"SUB_CATEGORY_INSERT_SUCESS" => "Sub Category Insert Successfully.",
		"SUB_CATEGORY_INSERT_FAILED" => "Sub Category Insert Failed.",
		"SUB_CATEGORY_UPDATE_SUCESS" => "Sub Category Update Successfully.",
		"SUB_CATEGORY_UPDATE_FAILED" => "Sub Category Update Failed.",
		"SUB_CATEGORY_DELETE_SUCESS" => "Sub Category Delete Successfully.",
		"SUB_CATEGORY_DELETE_FAILED" => "Sub Category Delete Failed.",
		"SUB_CATEGORY_GET_SUCESS" => "Sub Category Detail Get Successfully.",
		"SUB_CATEGORY_GET_FAILED" => "Sub Category Detail Get Failed.",
		"SUB_CATEGORY_STATUS_SUCESS" => "Sub Category Status Update Successfully.",
		"SUB_CATEGORY_STATUS_FAILED" => "Sub Category Status Update Failed.",

		//Department Master
		"DEPARTMENT_INSERT_SUCESS" => "Department Insert Successfully.",
		"DEPARTMENT_INSERT_FAILED" => "Department Insert Failed.",
		"DEPARTMENT_UPDATE_SUCESS" => "Department Update Successfully.",
		"DEPARTMENT_UPDATE_FAILED" => "Department Update Failed.",
		"DEPARTMENT_DELETE_SUCESS" => "Department Delete Successfully.",
		"DEPARTMENT_DELETE_FAILED" => "Department Delete Failed.",
		"DEPARTMENT_GET_SUCESS"   => "Department Detail Get Successfully.",
		"DEPARTMENT_GET_FAILED"   => "Department Detail Get Failed.",
		"DEPARTMENT_STATUS_SUCESS" => "Department Status Update Successfully.",
		"DEPARTMENT_STATUS_FAILED" => "Department Status Update Failed.",

		//Category Master
		"CATEGORY_INSERT_SUCESS" => "Category Insert Successfully.",
		"CATEGORY_INSERT_FAILED" => "Category Insert Failed.",
		"CATEGORY_UPDATE_SUCESS" => "Category Update Successfully.",
		"CATEGORY_UPDATE_FAILED" => "Category Update Failed.",
		"CATEGORY_DELETE_SUCESS" => "Category Delete Successfully.",
		"CATEGORY_DELETE_FAILED" => "Category Delete Failed.",
		"CATEGORY_GET_SUCESS"   => "Category Detail Get Successfully.",
		"CATEGORY_GET_FAILED"   => "Category Detail Get Failed.",
		"CATEGORY_STATUS_SUCESS" => "Category Status Update Successfully.",
		"CATEGORY_STATUS_FAILED" => "Category Status Update Failed.",


		//Popup Master
		"POPUP_INSERT_SUCESS" => "Popup Insert Successfully.",
		"POPUP_INSERT_FAILED" => "Popup Insert Failed.",
		"POPUP_UPDATE_SUCESS" => "Popup Update Successfully.",
		"POPUP_UPDATE_FAILED" => "Popup Update Failed.",
		"POPUP_DELETE_SUCESS" => "Popup Delete Successfully.",
		"POPUP_DELETE_FAILED" => "Popup Delete Failed.",
		"POPUP_GET_SUCESS"   => "Popup Detail Get Successfully.",
		"POPUP_GET_FAILED"   => "Popup Detail Get Failed.",
		"POPUP_STATUS_SUCESS" => "Popup Status Update Successfully.",
		"POPUP_STATUS_FAILED" => "Popup Status Update Failed.",

		//FAQ Master
		"FAQ_INSERT_SUCESS" => "FAQ Insert Successfully.",
		"FAQ_INSERT_FAILED" => "FAQ Insert Failed.",
		"FAQ_UPDATE_SUCESS" => "FAQ Update Successfully.",
		"FAQ_UPDATE_FAILED" => "FAQ Update Failed.",
		"FAQ_DELETE_SUCESS" => "FAQ Delete Successfully.",
		"FAQ_DELETE_FAILED" => "FAQ Delete Failed.",
		"FAQ_GET_SUCESS"   => "FAQ Detail Get Successfully.",
		"FAQ_GET_FAILED"   => "FAQ Detail Get Failed.",
		"FAQ_STATUS_SUCESS" => "FAQ Status Update Successfully.",
		"FAQ_STATUS_FAILED" => "FAQ Status Update Failed.",



		//QUERY Master
		"QUERY_INSERT_SUCESS" => "Query Insert Successfully.",
		"QUERY_INSERT_FAILED" => "Query Insert Failed.",
		"QUERY_UPDATE_SUCESS" => "Query Update Successfully.",
		"QUERY_UPDATE_FAILED" => "Query Update Failed.",
		"QUERY_DELETE_SUCESS" => "Query Delete Successfully.",
		"QUERY_DELETE_FAILED" => "Query Delete Failed.",
		"QUERY_GET_SUCESS"   => "Query Detail Get Successfully.",
		"QUERY_GET_FAILED"   => "Query Detail Get Failed.",
		"QUERY_STATUS_SUCESS" => "Query Status Update Successfully.",
		"QUERY_STATUS_FAILED" => "Query Status Update Failed.",



		//Plan Master
		"PLAN_INSERT_SUCESS" => "Plan Insert Successfully.",
		"PLAN_INSERT_FAILED" => "Plan Insert Failed.",
		"PLAN_UPDATE_SUCESS" => "Plan Update Successfully.",
		"PLAN_UPDATE_FAILED" => "Plan Update Failed.",
		"PLAN_DELETE_SUCESS" => "Plan Delete Successfully.",
		"PLAN_DELETE_FAILED" => "Plan Delete Failed.",
		"PLAN_GET_SUCESS"   => "Plan Detail Get Successfully.",
		"PLAN_GET_FAILED"   => "Plan Detail Get Failed.",
		"PLAN_STATUS_SUCESS" => "Plan Status Update Successfully.",
		"PLAN_STATUS_FAILED" => "Plan Status Update Failed.",



		//Subscription Master
		"SUBSCRIPTION_INSERT_SUCESS" => "Subscription Insert Successfully.",
		"SUBSCRIPTION_INSERT_FAILED" => "Subscription Insert Failed.",
		"SUBSCRIPTION_UPDATE_SUCESS" => "Subscription Update Successfully.",
		"SUBSCRIPTION_UPDATE_FAILED" => "Subscription Update Failed.",
		"SUBSCRIPTION_DELETE_SUCESS" => "Subscription Delete Successfully.",
		"SUBSCRIPTION_DELETE_FAILED" => "Subscription Delete Failed.",
		"SUBSCRIPTION_GET_SUCESS"   => "Subscription Detail Get Successfully.",
		"SUBSCRIPTION_GET_FAILED"   => "Subscription Detail Get Failed.",
		"SUBSCRIPTION_STATUS_SUCESS" => "Subscription Status Update Successfully.",
		"SUBSCRIPTION_STATUS_FAILED" => "Subscription Status Update Failed.",




		//Testimonial
		"TESTIMONIAL_INSERT_SUCESS" => "Testimonial Insert Successfully.",
		"TESTIMONIAL_INSERT_FAILED" => "Testimonial Insert Failed.",
		"TESTIMONIAL_UPDATE_SUCESS" => "Testimonial Update Successfully.",
		"TESTIMONIAL_UPDATE_FAILED" => "Testimonial Update Failed.",
		"TESTIMONIAL_DELETE_SUCESS" => "Testimonial Delete Successfully.",
		"TESTIMONIAL_DELETE_FAILED" => "Testimonial Delete Failed.",
		"TESTIMONIAL_GET_SUCESS"   => "Testimonial Detail Get Successfully.",
		"TESTIMONIAL_GET_FAILED"   => "Testimonial Detail Get Failed.",
		"TESTIMONIAL_STATUS_SUCESS" => "Testimonial Status Update Successfully.",
		"TESTIMONIAL_STATUS_FAILED" => "Testimonial Status Update Failed.",


		//City Master
		"CITY_INSERT_SUCESS" => "City Insert Successfully.",
		"CITY_INSERT_FAILED" => "City Insert Failed.",
		"CITY_UPDATE_SUCESS" => "City Update Successfully.",
		"CITY_UPDATE_FAILED" => "City Update Failed.",
		"CITY_DELETE_SUCESS" => "City Delete Successfully.",
		"CITY_DELETE_FAILED" => "City Delete Failed.",
		"CITY_GET_SUCESS"	=> "City Detail Get Successfully.",
		"CITY_GET_FAILED"	=> "City Detail Get Failed.",
		"CITY_STATUS_SUCESS" => "City Status Update Successfully.",
		"CITY_STATUS_FAILED" => "City Status Update Failed.",



		//Review

		"REVIEW_DELETE_SUCESS" => "Review Delete Successfully.",
		"REVIEW_DELETE_FAILED" => "Review Delete Failed.",

		//Quotation

		"QUOTATION_DELETE_SUCESS" => "Quotation Delete Successfully.",
		"QUOTATION_DELETE_FAILED" => "Quotation Delete Failed.",

		//Image
		"IMAGE_INSERT_SUCESS" => "Image Insert Successfully.",
		"IMAGE_INSERT_FAILED" => "Image Insert Failed.",
		"IMAGE_DELETE_SUCESS" => "Image Delete Successfully.",
		"IMAGE_DELETE_FAILED" => "Image Delete Failed.",
		"IMAGE_UPDATE_SUCESS" => "Image Update Successfully.",
		"IMAGE_UPDATE_FAILED" => "Image Update Failed.",

		//Video
		"VIDEO_INSERT_SUCESS" => "Video Insert Successfully.",
		"VIDEO_INSERT_FAILED" => "Video Insert Failed.",
		"VIDEO_DELETE_SUCESS" => "Video Delete Successfully.",
		"VIDEO_DELETE_FAILED" => "Video Delete Failed.",
		"VIDEO_UPDATE_SUCESS" => "Video Update Successfully.",
		"VIDEO_UPDATE_FAILED" => "Video Update Failed.",
		"VIDEO_STATUS_SUCESS" => "Video Status Updated Successfully.",
		"VIDEO_STATUS_FAILED" => "Video Status Updated Failed.",

		//File
		"FILE_INSERT_SUCESS" => "File Insert Successfully.",
		"FILE_INSERT_FAILED" => "File Insert Failed.",
		"FILE_DELETE_SUCESS" => "File Delete Successfully.",
		"FILE_DELETE_FAILED" => "File Delete Failed.",
		"FILE_UPDATE_SUCESS" => "File Update Successfully.",
		"FILE_UPDATE_FAILED" => "File Update Failed.",
		"FILE_STATUS_SUCESS" => "File Status Updated Successfully.",
		"FILE_STATUS_FAILED" => "File Status Updated Failed.",


		//Book
		"BOOK_INSERT_SUCESS" => "Book Insert Successfully.",
		"BOOK_INSERT_FAILED" => "Book Insert Failed.",
		"BOOK_DELETE_SUCESS" => "Book Delete Successfully.",
		"BOOK_DELETE_FAILED" => "Book Delete Failed.",
		"BOOK_UPDATE_SUCESS" => "Book Update Successfully.",
		"BOOK_UPDATE_FAILED" => "Book Update Failed.",
		"BOOK_STATUS_SUCESS" => "Book Status Updated Successfully.",
		"BOOK_STATUS_FAILED" => "Book Status Updated Failed.",

		//Brand Master
		"BRAND_INSERT_SUCESS" => "Brand Insert Successfully.",
		"BRAND_INSERT_FAILED" => "Brand Insert Failed.",
		"BRAND_UPDATE_SUCESS" => "Brand Update Successfully.",
		"BRAND_UPDATE_FAILED" => "Brand Update Failed.",
		"BRAND_DELETE_SUCESS" => "Brand Delete Successfully.",
		"BRAND_DELETE_FAILED" => "Brand Delete Failed.",
		"BRAND_GET_SUCESS"	 => "Brand Detail Get Successfully.",
		"BRAND_GET_FAILED"	 => "Brand Detail Get Failed.",
		"BRAND_STATUS_SUCESS" => "Brand Status Update Successfully.",
		"BRAND_STATUS_FAILED" => "Brand Status Update Failed.",
		
		//Service Master
		"SERVICE_INSERT_SUCESS" => "Service Insert Successfully.",
		"SERVICE_INSERT_FAILED" => "Service Insert Failed.",
		"SERVICE_UPDATE_SUCESS" => "Service Update Successfully.",
		"SERVICE_UPDATE_FAILED" => "Service Update Failed.",
		"SERVICE_DELETE_SUCESS" => "Service Delete Successfully.",
		"SERVICE_DELETE_FAILED" => "Service Delete Failed.",
		"SERVICE_GET_SUCESS"	 => "Service Detail Get Successfully.",
		"SERVICE_GET_FAILED"	 => "Service Detail Get Failed.",
		"SERVICE_STATUS_SUCESS" => "Service Status Update Successfully.",
		"SERVICE_STATUS_FAILED" => "Service Status Update Failed.",
		//modal Master
		"MODAL_INSERT_SUCESS" => "Modal Insert Successfully.",
		"MODAL_INSERT_FAILED" => "Modal Insert Failed.",
		"MODAL_UPDATE_SUCESS" => "Modal Update Successfully.",
		"MODAL_UPDATE_FAILED" => "Modal Update Failed.",
		"MODAL_DELETE_SUCESS" => "Modal Delete Successfully.",
		"MODAL_DELETE_FAILED" => "Modal Delete Failed.",
		"MODAL_GET_SUCESS"	 => "Modal Detail Get Successfully.",
		"MODAL_GET_FAILED"	 => "Modal Detail Get Failed.",
		"MODAL_STATUS_SUCESS" => "Modal Status Update Successfully.",
		"MODAL_STATUS_FAILED" => "Modal Status Update Failed.",

		//device problem Master
		"DEVICE_PROBLEM_INSERT_SUCESS" => "Device Problem Insert Successfully.",
		"DEVICE_PROBLEM_INSERT_FAILED" => "Device Problem Insert Failed.",
		"DEVICE_PROBLEM_UPDATE_SUCESS" => "Device Problem Update Successfully.",
		"DEVICE_PROBLEM_UPDATE_FAILED" => "Device Problem Update Failed.",
		"DEVICE_PROBLEM_DELETE_SUCESS" => "Device Problem Delete Successfully.",
		"DEVICE_PROBLEM_DELETE_FAILED" => "Device Problem Delete Failed.",
		"DEVICE_PROBLEM_GET_SUCESS"	 => "Device Problem Detail Get Successfully.",
		"DEVICE_PROBLEM_GET_FAILED"	 => "Device Problem Detail Get Failed.",
		"DEVICE_PROBLEM_STATUS_SUCESS" => "Device Problem Status Update Successfully.",
		"DEVICE_PROBLEM_STATUS_FAILED" => "Device Problem Status Update Failed.",

		//Best Sellers Product Master
		"BESTSELLERS_INSERT_SUCESS" => "Best Sellers Product Insert Successfully.",
		"BESTSELLERS_INSERT_FAILED" => "Best Sellers Product Insert Failed.",
		"BESTSELLERS_UPDATE_SUCESS" => "Best Sellers Product Update Successfully.",
		"BESTSELLERS_UPDATE_FAILED" => "Best Sellers Product Update Failed.",
		"BESTSELLERS_DELETE_SUCESS" => "Best Sellers Product Delete Successfully.",
		"BESTSELLERS_DELETE_FAILED" => "Best Sellers Product Delete Failed.",
		"BESTSELLERS_GET_SUCESS"	 => "Best Sellers Product Detail Get Successfully.",
		"BESTSELLERS_GET_FAILED"	 => "Best Sellers Product Detail Get Failed.",
		"BESTSELLERS_STATUS_SUCESS" => "Best Sellers Product Status Update Successfully.",
		"BESTSELLERS_STATUS_FAILED" => "Best Sellers Product Status Update Failed.",


		//Unit Master
		"UNIT_INSERT_SUCESS" => "Unit Insert Successfully.",
		"UNIT_INSERT_FAILED" => "Unit Insert Failed.",
		"UNIT_UPDATE_SUCESS" => "Unit Update Successfully.",
		"UNIT_UPDATE_FAILED" => "Unit Update Failed.",
		"UNIT_DELETE_SUCESS" => "Unit Delete Successfully.",
		"UNIT_DELETE_FAILED" => "Unit Delete Failed.",
		"UNIT_GET_SUCESS"	=> "Unit Detail Get Successfully.",
		"UNIT_GET_FAILED"	=> "Unit Detail Get Failed.",
		"UNIT_STATUS_SUCESS" => "Unit Status Update Successfully.",
		"UNIT_STATUS_FAILED" => "Unit Status Update Failed.",


		//Popup Master
		"POPUP_INSERT_SUCESS" => "Popup Insert Successfully.",
		"POPUP_INSERT_FAILED" => "Popup Insert Failed.",
		"POPUP_UPDATE_SUCESS" => "Popup Update Successfully.",
		"POPUP_UPDATE_FAILED" => "Popup Update Failed.",
		"POPUP_DELETE_SUCESS" => "Popup Delete Successfully.",
		"POPUP_DELETE_FAILED" => "Popup Delete Failed.",
		"POPUP_GET_SUCESS"   => "Popup Detail Get Successfully.",
		"POPUP_GET_FAILED"   => "Popup Detail Get Failed.",
		"POPUP_STATUS_SUCESS" => "Popup Status Update Successfully.",
		"POPUP_STATUS_FAILED" => "Popup Status Update Failed.",


		//Designation
		"DESIGNATION_INSERT_SUCESS" => "Designation Insert Successfully.",
		"DESIGNATION_INSERT_FAILED" => "Designation Insert Failed.",
		"DESIGNATION_UPDATE_SUCESS" => "Designation Update Successfully.",
		"DESIGNATION_UPDATE_FAILED" => "Designation Update Failed.",
		"DESIGNATION_DELETE_SUCESS" => "Designation Delete Successfully.",
		"DESIGNATION_DELETE_FAILED" => "Designation Delete Failed.",
		"DESIGNATION_GET_SUCESS"	=> "Designation Detail Get Successfully.",
		"DESIGNATION_GET_FAILED"	=> "Designation Detail Get Failed.",
		"DESIGNATION_STATUS_SUCESS" => "Designation Status Update Successfully.",
		"DESIGNATION_STATUS_FAILED" => "Designation Status Update Failed.",


		//ID Proof Master
		"IDPROOF_INSERT_SUCESS" => "ID Proof Insert Successfully.",
		"IDPROOF_INSERT_FAILED" => "ID Proof Insert Failed.",
		"IDPROOF_UPDATE_SUCESS" => "ID Proof Update Successfully.",
		"IDPROOF_UPDATE_FAILED" => "ID Proof Update Failed.",
		"IDPROOF_DELETE_SUCESS" => "ID Proof Delete Successfully.",
		"IDPROOF_DELETE_FAILED" => "ID Proof Delete Failed.",
		"IDPROOF_GET_SUCESS"	=> "ID Proof Detail Get Successfully.",
		"IDPROOF_GET_FAILED"	=> "ID Proof Detail Get Failed.",
		"IDPROOF_STATUS_SUCESS" => "ID Proof Status Update Successfully.",
		"IDPROOF_STATUS_FAILED" => "ID Proof Status Update Failed.",

		//packing type Master
		"PACKING_TYPE_INSERT_SUCESS" => "Packing Type Insert Successfully.",
		"PACKING_TYPE_INSERT_FAILED" => "Packing Type Insert Failed.",
		"PACKING_TYPE_UPDATE_SUCESS" => "Packing Type Update Successfully.",
		"PACKING_TYPE_UPDATE_FAILED" => "Packing Type Update Failed.",
		"PACKING_TYPE_DELETE_SUCESS" => "Packing Type Delete Successfully.",
		"PACKING_TYPE_DELETE_FAILED" => "Packing Type Delete Failed.",
		"PACKING_TYPE_GET_SUCESS"	=> "Packing Type Detail Get Successfully.",
		"PACKING_TYPE_GET_FAILED"	=> "Packing Type Detail Get Failed.",
		"PACKING_TYPE_STATUS_SUCESS" => "Packing Type Status Update Successfully.",
		"PACKING_TYPE_STATUS_FAILED" => "Packing Type Status Update Failed.",

		//Store Master
		"STORE_INSERT_SUCESS" => "Store Insert Successfully.",
		"STORE_INSERT_FAILED" => "Store Insert Failed.",
		"STORE_UPDATE_SUCESS" => "Store Update Successfully.",
		"STORE_UPDATE_FAILED" => "Store Update Failed.",
		"STORE_DELETE_SUCESS" => "Store Delete Successfully.",
		"STORE_DELETE_FAILED" => "Store Delete Failed.",
		"STORE_GET_SUCESS"	 => "Store Detail Get Successfully.",
		"STORE_GET_FAILED"	 => "Store Detail Get Failed.",
		"STORE_STATUS_SUCESS" => "Store Status Update Successfully.",
		"STORE_STATUS_FAILED" => "Store Status Update Failed.",

		//Vehical Master
		"VEHICAL_INSERT_SUCESS" => "Vehical Insert Successfully.",
		"VEHICAL_INSERT_FAILED" => "Vehical Insert Failed.",
		"VEHICAL_UPDATE_SUCESS" => "Vehical Update Successfully.",
		"VEHICAL_UPDATE_FAILED" => "Vehical Update Failed.",
		"VEHICAL_DELETE_SUCESS" => "Vehical Delete Successfully.",
		"VEHICAL_DELETE_FAILED" => "Vehical Delete Failed.",
		"VEHICAL_GET_SUCESS"	 => "Vehical Detail Get Successfully.",
		"VEHICAL_GET_FAILED"	 => "Vehical Detail Get Failed.",
		"VEHICAL_STATUS_SUCESS" => "Vehical Status Update Successfully.",
		"VEHICAL_STATUS_FAILED" => "Vehical Status Update Failed.",

		//Issue Ticket Type Master
		"ISSUE_TYPE_INSERT_SUCESS" => "Ticket Issue Type Insert Successfully.",
		"ISSUE_TYPE_INSERT_FAILED" => "Ticket Issue Type Insert Failed.",
		"ISSUE_TYPE_UPDATE_SUCESS" => "Ticket Issue Type Update Successfully.",
		"ISSUE_TYPE_UPDATE_FAILED" => "Ticket Issue Type Update Failed.",
		"ISSUE_TYPE_DELETE_SUCESS" => "Ticket Issue Type Delete Successfully.",
		"ISSUE_TYPE_DELETE_FAILED" => "Ticket Issue Type Delete Failed.",
		"ISSUE_TYPE_GET_SUCESS"	  => "Ticket Issue Type Detail Get Successfully.",
		"ISSUE_TYPE_GET_FAILED"	  => "Ticket Issue Type Detail Get Failed.",
		"ISSUE_TYPE_STATUS_SUCESS" => "Ticket Issue Type Status Update Successfully.",
		"ISSUE_TYPE_STATUS_FAILED" => "Ticket Issue Type Status Update Failed.",

		"VENDOR_INSERT" => " Vendor Added",
		"VENDOR_UPDATE" => " Vendor Updated",
		"VENDOR_DELETE" => " Vendor Deleted",
		"VENDOR_DELETE_FAILED" => " Vendor Deleted Failed",

		"MANUFACTURE_INSERT" => "Manufacture Added",
		"MANUFACTURE_UPDATE" => " Manufacture Updated",
		"MANUFACTURE_DELETE" => " Manufacture Deleted",
		"MANUFACTURE_DELETE_FAILED" => " Manufacture Deleted Failed",

		"ORDER_INSERT" => "Order Added Successfully!!",
		"ORDER_UPDATE" => "Order Updated Successfully!!",
		"ORDER_DELETE" => "Order Deleted Successfully!!",
		"ORDER_ACTIVE" => "Order Status Update Successfully!!",

		"NOTIFICATION_DELETE_SUCCESS" => "Notification Delete Successfully !!",
		"NOTIFICATION_DELETE_FAILED" => "Notification Delete Failed !!",


		"STORE_MASTER_INSERT" => "Store Added Successfully!!",
		"STORE_MASTER_UPDATE" => "Store Updated Successfully!!",
		"STORE_MASTER_DELETE" => "Store Deleted Successfully!!",


		"ORDERS_INSERT" => " Order Added Successfully!!",
		"ORDERS_INSERT_FAILED" => "Order Detail Added Failed.",
		"ORDERS_CREDIT_NOT_ENOUGH" => "Your Credit Limit Not Enough.",
		"ORDERS_UPDATE" => " Order Updated Successfully!!",
		"ORDERS_DELETE" => " Order Deleted Successfully!!",

		"PURCHASE_ORDER_INSERT" => " Purchase Order Added Successfully!!",
		"PURCHASE_ORDER_UPDATE" => " Purchase Order Updated Successfully!!",
		"PURCHASE_ORDER_DELETE" => " Purchase Order Deleted Successfully!!",

		"PURCHASE_INDENT_INSERT" => " Purchase Indent Added Successfully!!",
		"PURCHASE_INDENT_UPDATE" => " Purchase Indent Updated Successfully!!",
		"PURCHASE_INDENT_DELETE" => " Purchase Indent Deleted Successfully!!",

		"MATERIAL_REQUEST_INSERT" => " Material Request Added Successfully!!",
		"MATERIAL_REQUEST_UPDATE" => " Material Request Updated Successfully!!",
		"MATERIAL_REQUEST_DELETE" => " Material Request Deleted Successfully!!",

		"INWARD_STORE_INSERT" => " Inward Stre Added Successfully!!",
		"INWARD_STORE_UPDATE" => " Inward Stre Updated Successfully!!",
		"INWARD_STORE_DELETE" => " Inward Stre Deleted Successfully!!",

		"OUTWARD_STORE_INSERT" => " Outward Store Added Successfully!!",
		"OUTWARD_STORE_UPDATE" => " Outward Store Updated Successfully!!",
		"OUTWARD_STORE_DELETE" => " Outward Store Deleted Successfully!!",

		/*-------------- SERVICE MESSAGE --------------------*/
		"INVALID_API_SERVICE" => "Authentication Failed!!\n\n Contact To Administrator",
		"PARAMETER_MISSING_SERVICE" => "Service Parameter missing or not valid!!",
		"INTERNAL_ERROR_SERVICE" => "Internal Error!! Try Later",

		//get all state
		"STATE_DETAIL_SUCESS" => "State detail found.",

		//get all CITY
		"CITY_DETAIL_SUCESS" => "City detail found.",

		//get service orders & cancel order
		"SERVICE_ORDER_ITEM_GET_SUCESS" => "Successfully Get Orders !!",
		"SERVICE_ORDER_CANCEL_SUCESS" => "Successfully Cancel Orders !!",
		"SERVICE_ORDER_ITEM_GET_FAILED" => "Order Item Not Available!!",
		"SERVICE_ORDER_GET_FAILED" => "Order Not Available!!",

		//sales executive 
		"SERVICE_SALES_EXECUTIVE_GET_SUCESS" => "Success! Sales Executive Fetched Successfully.",

		//PAYMENT 
		"OTP_SEND_SUCESS" => "OTP Send Successfully!!",
		"OTP_SEND_FAILED" => "OTP Send Failed!!",


		//LOGIN customer
		"CUSTOMER_LOGIN_SUCESS" => "Customer Login Successfully.",
		"CUSTOMER_LOGIN_FAILED" => "Email OR Password not match.",
		"CUSTOMER_LOGIN_NOT_REGISTERED" => "Email not registered.",
		"CUSTOMER_LOGIN_NOT_VALID" => "Invalid details.",
		"CUSTOMER_LOGIN_NOT_FOUND" => "Internal Error!!.",

		//employee
		"EMPLOYEE_DETAIL_SUCESS" => "Successfully Fetched Employee!!",
		"EMPLOYEE_DETAIL_NOT_FOUND" => "Employee Detail Not Found!!",

		//LOGIN employee
		"EMPLOYEE_LOGIN_SUCESS" => "Employee Login Successfully.",
		"EMPLOYEE_LOGIN_FAILED" => "Email OR Password not match.",
		"EMPLOYEE_LOGIN_NOT_REGISTERED" => "Email not registered.",
		"EMPLOYEE_LOGIN_NOT_VALID" => "Invalid details.",
		"EMPLOYEE_LOGIN_NOT_FOUND" => "Internal Error!!.",

		//Send Mail
		"SEND_MAIL_SUCESS" => "Check Your Mail For Security Code!!",
		"SEND_MAIL_FAILED" => "Sorry We Can't Proceed Right Now Try Later!!",
		"USER_LOGIN_FAILED" => "User Login Failed.",
		"USER_NOT_FOUND" => "Given User Not Exists!",

		//notification
		"NOTIFICATION_SEND_SUCESS" => "Notification Send Successfully!!",
		"NOTIFICATION_GET_SUCESS" => "Successfully Get notification !!",
		"NOTIFICATION_GET_FAILED" => "No notification Found !!",
		"NOTIFICATION_DELETE_SUCCESS" => "Notification Delete Successfully !!",
		"NOTIFICATION_DELETE_FAILED" => "Notification Delete Failed !!",


		//view dealer profile
		"DEALER_DETAIL_SUCESS" => "Dealer Profile Detail Get Successfully.",
		"DEALER_DETAIL_FAILED" => "No Dealer Found!!!",

		//VERIFY OTP
		"DEALER_VERIFY_OTP_SUCESS" => "OTP Verified Successfully.",
		"DEALER_VERIFY_OTP_FAILED" => "OTP Not Match!!",

		//add issue ticket 
		"ISSUE_TICKET_INSERT_SUCESS_SERVICE" => "Issue Ticket Add Successfully.",

		//VIEW ISSUE TICKET OF DEALER
		"ISSUE_TICKET_DETAIL_SUCESS" => "Issue Ticket Detail Get Successfully.",
		"ISSUE_TICKET_DETAIL_FAILED" => "Issue Ticket Detail Get Failed.",

		//TYPE OF ISSUE
		"TYPE_ISSUE_TICKET_DETAIL_SUCESS" => "Type of Issue Ticket Get Successfully.",
		"TYPE_ISSUE_TICKET_DETAIL_FAILED" => "No Ticket Found.",

		//get Product
		"PRODUCT_DETAIL_SUCESS" => "You got it!!",

		//get Order List
		"ORDERS_LIST_GET_SUCESS" => "Successfully Get Orders.",
		"ORDERS_LIST_GET_FAILED" => "Order Get Failed.",
		"NO_ORDER_FOUND" => "No Order Found.",

		//get Dealer payment List
		"DEALER_PAYMENT_LIST_GET_SUCESS" => "Dealer Payment Get Successfully.",
		"DEALER_PAYMENT_LIST_GET_FAILED" => "Dealer Payment Get Failed.",
		"NO_DEALER_FOUND" => "Dealer Not Found.",

		//get Dispatch Note
		"INVOICE_GET_SUCESS" => "Invoice  Get Successfully.",
		"INVOICE_GET_FAILED" => "Invoice  Get Failed.",


		//claimed offer
		"CLAIMED_OFFER_GET_SUCESS" => "Successfully Get Claimed Offer!!",
		"CLAIMED_OFFER_GET_FAILED" => "Claimed Offer not Found !!",
		"CLAIMED_OFFER_SUCESS" => "Offer Claimed",
		"CLAIMED_OFFER_DEALER_FAILED" => "No dealer found for this dealer",
		"CLAIMED_OFFER_EXPIRED" => "No offer expire today",

		//Customer account detail
		"CUSTOMER_ACCOUNT_GET_SUCESS" => "Customer Account Detail Fetch Successfully!!.",
		"CUSTOMER_ACCOUNT_GET_FAILED" => "Customer Account detail not available.",
		"CUSTOMER_NOT_AVAILABLE" => "Customer Not Available.",

		//Credit Note File detail
		"CREDIT_NOTE_GANERATED_SUCCESS" => "Credit Note Detail Fetch Successfully!!.",
		"CREDIT_NOTE_GANERATED_FAILED" => "Credit Note detail not available.",



		//Delete order
		"DELETE_ORDER_SUCESS" => "Success! Order delete Successfully!!",
		"DELETE_ORDER_FAILED" => "Order can not deleted.",
		"DELETE_DISPATCH_ORDER_ITEM_FAILED" => "Order Item can not deleted!! Order Item Dispatched.",
		"DELETE_ORDER_DETAIL_FAILED" => "Sorry! Order Delete Failed !! Please Try Again Later!!",

		//add to cart
		"ADD_CART_QTY_UPDATED_SUCESS" => "Product already in cart quantity updated!!",
		"ADD_CART_QTY_UPDATED_FAILED" => "Product can't added to cart internal error!!",
		"ADD_CART_PRODUCT_SUCESS" => "Product added to cart!!",
		"ADD_CART_PRODUCT_FAILED" => "Product can't added to cart internal error!!",
		"ADD_CART_REMOVE_PRODUCT" => "Product is removed!!",
		"ADD_CART_QTY_NOT_AVAILABLE" => "Required Qty. Not Available in Stock ",

		"PRODUCT_NOT_AVAILABLE" => "Product Not Found!!",
		"USER_NOT_AVAILABLE" => "User Not Found!!",

		//remove cart item
		"REMOVE_CART_ITEM_SUCCESS" => "Item Successfully Removed From Cart!!",
		"REMOVE_CART_ITEM_FAILED" => "Cart Item Can't Remove Try Later!!!",
		"CART_ITEM_NOT_AVAILABLE" => "Cart Item Not Found!!",

		//UPDATE CART Item
		"UPDATE_CART_ITEM_SUCCESS" => "Cart Items Updated!!",
		"UPDATE_CART_ITEM_FAILED" => "Cart Detail Not Updated!!",
		"CART_ID_NOT_AVAILABLE" => "Cart Id Not Found!!",

		//Order CART detail
		"CART_DETAIL_NOT_FOUND" => "Cart Detail Not Found!!",
		"DISPATCH_GET_SUCESS" => "Dispatch get Succsess",
		"NO_DISPATCH_FOUND" => "No Dispatch Found.",

		//Get Cart Detail 
		"CART_DETAIL_GET_SUCCESS" => "You got it!!",
		"CART_DETAIL_GET_FAILED" => "No Cart Items found!!",

		"INVOICE_SUBMIT_SUCCESS" => "Invoice Generated",
		"INVOICE_SUBMIT_FAIL" => "Invoice Failed.",
	);
	function __construct($id = "")
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db = $db;
	}
	public function insertLog($table_name, $ref_id, $activity_type, $activity_description)
	{
		$ip = $this->db->rp_get_client_ip();
		if (isset($_SESSION[SITE_SESS . '_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'] != "" && 		isset($_SESSION[SITE_SESS . '_ADMIN_TYPE']) && $_SESSION[SITE_SESS . '_ADMIN_TYPE'] != "") {
			$user_id = $_SESSION[SITE_SESS . '_ADMIN_SESS_ID'];
			$user_type = $_SESSION[SITE_SESS . '_ADMIN_TYPE'];
		} else {
			if (is_writable(LOG_FILE)) {

				$file = fopen(LOG_FILE, "a");
				fwrite($file, "From IP " . $ip . " Entry is modified or inserted but Session not created DATETIME " . date("Y-m-d H:i:s") . PHP_EOL);
				fclose($file);
			}
			$user_id = 5895;
			$user_type = 0712;
		}
		$rows = array("table_name", "ref_id", "activity_type", "activity_description", "activity_date", "user_id", "user_type", "ip");
		$values = array($table_name, $ref_id, $activity_type, $activity_description, date("Y-m-d H:i:s"), $user_id, $user_type, $ip);
		$this->rp_insert($this->ctable, $values, $rows, 0);
	}

	public function viewLog($user_id = "")
	{
		$items = array();
		if ($user_id != "") {
			$where = "user_id='" . $user_id . "'";
		} else {
			$where = "1=1";
		}

		$ctable_r = $this->db->rp_getData($ctable, "*", $where);
		if ($ctable_r) {
			while ($ctable_d = mysqli_fetch_assoc($ctable_r)) {
				$items[] = $ctable_d;
			}
		}
		return $items;
	}


	public function getMessage($code, $type = 0)
	{
		if ($type == 0) {

			// ACK MESSAGE
			return $this->ackMessage[$code];
		} else {
			return $this->developerMessage[$code];
		}
	}
	public function addSMSLog($mobile_no, $sms, $status)
	{
		$inserted_id = $this->db->rp_insert($this->ctableSMSLog, array($mobile_no, htmlentities($this->db->clean($sms)), htmlentities($this->db->clean($status))), array(
			"mobile_no", "msg", "status"
		), 0);
		if ($inserted_id != 0) {
			return true;
		} else {
			return false;
		}
	}
	public function addFirebaseLog($apikey, $url, $data, $refreshTokens, $reply)
	{
		$inserted_id = $this->db->rp_insert($this->ctableFirebaseLog, array($apikey, $url, addSlashes(json_encode($data)), addSlashes(json_encode($refreshTokens)), addSlashes(json_encode($reply))), array(
			"apiKey", "url", "data", "refreshTokens", "reply"
		), 0);
		if ($inserted_id != 0) {
			return true;
		} else {
			return false;
		}
	}

	public function addEmailLog($recipient, $subject, $message, $attachment, $from_email, $from_name, $date)
	{
		$inserted_id = $this->db->rp_insert($this->ctableEmail, array($recipient, $subject, $message, $attachment, $from_email, $from_name, $date), array(
			"recipient", "subject", "message", "attachment", "from_email", "from_name", "created_date"
		), 0);
		if ($inserted_id != 0) {
			return true;
		} else {
			return false;
		}
	}
}
