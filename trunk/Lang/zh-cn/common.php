<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-17
*/ 
$array=array(
'DO_OK'=>"Operation is successful",
'HOME'=>'首页',//首页文字
'ACCOUNT'=>'我的账户',//会员中心文字
'LOGOUT'=>'退出',//退出文字
'REGISETR'=>'免费注册',//注册文字
'LOGIN'=>'登录',//登录文字
'SHOPPING_CART'=>'购物车',//购物车文字
'SHOPPING_CART_MESSAGE'=>'您的购物车有',//购物车信息文字
'SHOPPING_CART_UNITS'=>'件',//购物车单位文字
'CURRENCIES'=>'货币',//选择货币文字
'HOT_SEARCH'=>'热门搜索',//热门搜索
'CATE_TITLE'=>'商品分类',//类别框标题
'BESTSELLERS_TITLE'=>'热卖商品',//热卖框标题
'SPECIALS_TITLE'=>'特价商品',//特价框标题
'FEATURED_TITLE'=>'推荐商品',//推荐框标题

'ABOUT_US'=>'About Us',
'CONTACT_US'=>'Contact Us',
'NEW_PRODUCTS'=>'New Products',
'NEED_HELP'=>'Need Help',
'LEAVE_MESSAGE'=>'Leave Message',
'ALL_CATEGORY'=>'All Category',

'TAGS'=>'Tags',
'BROSWER_HISTORY'=>'Broswer History',
'NEW_ARRIVAL_ITEMS'=>'New Arrival Items',
'HOT_SALES_ITEMS'=>'Hot Sales Items',
'SPECIAL_OFFERS'=>'Special Offers',
'LOGIN'=>'Login',
'USER_NAME'=>'User Name',
'PASSWORD'=>'Password',


'BUYER_GUIDE'=>'Buyer Guide',
'GOT_A_QUESTION'=>'Got a Question',
'SEND_AN_INQUIRY'=>'Send an Inquiry',
'TOP_10_BEESTSELLERS'=>'Top 10 Beestsellers',
'SEARCH'=>'Search',
'COPYRIGHT'=>'Copyright',
'ALL_RIGHT_RESERVED'=>'All right reserved',
'YOUR_POSITION'=>'Your Position',
'SORT_BY_TIME'=>'Sort by time',
'SORT_BY_PRICE'=>'Sort by price',
'SORT_BY_UPDATE'=>'Sort by update',
'DESCENDING'=>'Descending',
'ASCENDING'=>'Ascending',
'ALL_PRODUCTS'=>'All Products',
'DISPLAY'=>'Display',
'TOTAL'=>'Total',
'RECORDS'=>'Records',
'PAGES'=>'Pages',
'NEXT'=>'Next',
'LAST'=>'Last',
'PRODUCT_NAME'=>'Product Name',
'PRODUCT_ID'=>'Product ID',
'PRICE'=>'Price',
'ORIGINAL_PRICE'=>'Original Price',
'SIZE'=>'Size',
'QUANTITY'=>'Quantity',
'ADD_TO_CART'=>'Add To Cart',
'DESCRIPTION'=>'Description',
'RELATED_PRODUCTS'=>'Related products',
'STEP1'=>'Step1',
'THE_SHOPPING_CART'=>'The Shopping Cart',
'SHOPPING_ADDRESS'=>'Shopping Address',
'FINISH_ORDER'=>'Finish Order',
'ITEM_NAME'=>'Item Name',
'MODEL'=>'Model',
'PRICE'=>'Price',
'TOTAL'=>'Total',
'DELETE'=>'Delete',
'SUB_TOTAL'=>'Sub-Total',
'SHIPPING_FEE'=>'Shipping Fee',
'INSURANCE'=>'Insurance',
'PAY_FEE'=>'Pay Fee',
'TOTAL_PRICE'=>'Total Price',
'CONTINUE_SHOPPING'=>'Continue Shopping',
'CLEAR_CART'=>'Clear Cart ',
'CHECKOUT'=>'Checkout',
'MEMBERS_CENTRE'=>'Members Centre',
'MY_ACCOUNT_INFORMATION'=>'My Account Information',
'ENTER_YOUR_EMAIL_ADDRESS_AND_CREATE_A_PASSWORD'=>'Enter your email address and create a password',
'NOTE:'=>'NOTE:',
'FIRST_NAME'=>'First Name',
'LAST_NAME'=>'Last Name',
'EMAIL_ADDRESS'=>'Email Address',
'PASSWORD'=>'Password',
'CONFIRM_PASSWORD'=>'Confirm Password',
'CREATE_NEW_ACCOUNT'=>'Create New Account',
'RETURNING_CUSTOMERS'=>'Returning Customers',
'EMAIL'=>'E-mail',
'PASSWORD'=>'Password',
'FORGOT_YOUR_PASSWORD'=>'Forgot your password',
'WISH_LIST'=>'Wish List',
'CHANGE_PSSWORD'=>'Change Pssword',
'LOG_OUT'=>'Log Out',
'USER_CENTER'=>'User Center',
'HELP'=>'Help'
);
$alipay	=	require LANG_PATH.C('DEFAULT_LANG').'/alipay.php';
$array= array_merge($alipay,$array);
$member=require LANG_PATH.C('DEFAULT_LANG').'/member.php';
$array= array_merge($member,$array);
$cart=require LANG_PATH.C('DEFAULT_LANG').'/cart.php';
$array= array_merge($cart,$array);
return $array;
?>