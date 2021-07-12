# 12-Jul-21
## 0.8.4
### FIXED
- whitespace no wrape header info in write review page
### IMPROVE
- Chunk files main js

# 11-Jul-21
## 0.8.3
### FIXED
- Navbar height on IOS
- Pagination overflow change with limiting pagination with ellipsis
- overflow button for filter rating in company detail 
- white-space no wrap for summary data review tipe in header company detail
### CHANGED
- Redesign Filter rating and ordering button in company detail
- Move button "write a review" to the top while in mobile view
- hover color to success for autosearch
## 0.8.2
### ADDED
- Meta data for user detail and review detail
- Editor function for header and social
# 10-Jul-21
## 0.8.1
### ADDED
- Title in homepage
### FIXED
- parsefloat in rating

# 08-Jul-21
## 0.8.0
### ADDED
- Add notification error in review
- Clickable company name in company dashboard
- Filter type, status, answered in company dashboard
### FIXED
WEBSITE
- Hide "write a review" button while user already sent a review
- Logo and icon website


# 29-Jun-21
## 0.7.0
### ADDED
COMPANY
- Email notification after payment subcription premium membership success
- Email notification after user submit new review to company
- Cancel payment page and delete invoice in billing history if company cancel the checkout page
# 27-Jun-21
## 0.6.0
### ADDED
WEBSITE
- User Profile in User Detail
USER
- Forgot Password Feature
- Prohibited Login for UNACTIVE/SUSPENDED Account
- Able to see company respond in user dashboard
- Able to delete review
- Able to change review type 
- Change Password feature
- Input validation in company dashboard (My profile form)
- Prohibited normal login, forgot password, and change password if registered with FB or Google Login
COMPANY
- Forgot Password Feature
- Prohibited Login for UNACTIVE/SUSPENDED Account
- Email verfication feature after register
- Change Business Category in Company Dashboard
- Change Password feature
- Prohibited respond if review status is not in PUBLISHED
- Company able to edit and delete company respond for any review
- Able to change business category in company dashboard
- Input validation in company dashboard (Company respond form, My profile form)
ADMIN
- Admin Dashboard
- Business Category page (for view, create, update, delete)
- Automaticaly send email notification if company set the account status to active 

# 22-Jun-21
## 0.5.1
### ADDED
ADMIN
- Company dashboard page has button to open company panel
### CHANGED
WEBSITE
- User name only showing first name.
USER
- User can modify his/her own review in dashboard for status 'IN REVIEW' and 'SUSPENDED'
### FIXED
WEBSITE
- Responsiveness of user insight data user review card

# 20-Jun-21
## 0.5.0
### ADDED
WEBSITE
- Page for visit User
- Page for visit Single Review
- Counting visitor for Company page
- Counting visitor for review page
- Showing Like Dislike in review
- "Load More" feature for top company in homepage (with condition The company with Rating > 4 AND Review > 10)
- Place Ads area in company detail
- Common Words (refering a title & description review) as a Keywords in company detail
- Search input Keywords
- Peek a password input for user & company login
- Autosearch input for company name in write a review any company page
- Sidebar in mobile mode
- Link to company detail in top company area in title ada company avatar
- Rating in top company area

USER SIDE
- View Image Review (if image uploaded) in user dashboard 
- Social Login (Google & Facebook) with image profile
- Like Dislike system (User able to give like dislike for review)
- Insight data (visited, like, dislike) in table review dashboard

COMPANY SIDE
- Showing data for company detail visitor
- Showing data for total rating in company dashboard

ADMIN SIDE
- Button to visit user page in User list
- Search by date (using calendar) in review page
- Admin able to edit review title and description 
- Insight data (visited, like, dislike) in table review dashboard

### FIXED
WEBSITE
- Footer floating for short content page
- Alphabetic keywords appear in mobile mode

### CHANGED
WEBSITE
- Change "Write this company" button to "Write a Review"


### BACKLOG:
- Admin Dashboard

# 14-Jun-21
## 0.4.0
### ADDED
- Membership creator in admin
- Membership system in company
- Payment system with Stripe and Paypal
- Update Profile and upload photo for company and user
- Review any company system
- Editor feature (faq, about, membership plan, privacy policy, terms condition, agreement)
- Contact Form system
- Page for faq, contact, generel page for privacy policy, agreement, temr condition
- Submit review feature with upload photo
- photo placeholder (for user not yet upload photo)

### Backlog
- Social Login for user
- Admin dashboard
- see photo review in admin dashboard

# 7-Jun-21
## 0.3.0
### ADDED
User Side
- Login System
- Register System (via social media not yet)
- Review system in company detail (admin need to approve before publish to the main website)
- Review list in user dashboard (with instant search)
Company Side
- Login System
- Register System (after final production, company account need to be activated by admin)
- Respond/comment a Review system (currently all company can respond, will be lock to membership premium on the final producion)
- Report a review to admin (just incase user give a violence review, so admin will be suspending the review)
- Review List in company dashbaord (with instant search)
Website
- Autocomplete search
- Company listing
- Review listing in company detail
Admin Side
- Approval system for review
- Change Status for user
- Change Status for company
- User list (with instant search)
- Company list (with instant search)
- Review list (with instant search)

Backlog
- Login system for admin
- Update profile system for user and company
- Membership system
- General Editor system in admin
- Membership system in admin
- Social login system for user
- Write any company system (for unregistered company)
- Dashboard admin system

# 31-May-21
## 0.2.0
### ADDED
Admin Page
1. [v] Admin Login Page
2. [v] Admin Registration Page 
3. [v] Admin Dashboard (Showing Total User, Total Company, Total Review, Top Company, Recent Review Posted, Recent Company Registered)
4. [v] List All Registered Companies
5. [v] Detail Company (showing all review with admin ability to moderation/approving / delete inappropriate review, ability to verifying company) (moderation for review separated "review page")
6. [v] Payment methods Page (ability for update API Key for Stripe and Paypal, Ability for update availability payment for stripe and paypal ) (in page "third party page", altogether with page for defining secret key id for social login page)
7. [v] Company membership page (Ability to create and update availability membership price and duration)
8. [v] Common editor (ability to update about + terms+ privacy + FAQ + info pages + update URL social account)
9. [v] Adsense Page (ability to update update adsense code for each section) (for store client secret id)

### FIXED
1. Restore Hero big image for landing page

# 24-May-21
## 0.1.2
### FIXED
1. Reset Password Page
## 0.1.1
### FIXED
1. Url for each company (instead detail-company)
## 0.1
### ADDED
View for page below
1. [v] Homepage (with show listing company based on top company)
2. [v] Companies Category by Alphabetical Page
3. [v] Company detail page with dedicated Url Link (showing review, total rating)
4. [v] User Login Form Page
5. [v] User Register Form Page
6. [v] User Forgot password Page 
7. [v] User Dashboard (showing total review and list of review posted from current user)
8. [v] User Profile/Setting Page (Name, email)
9. [v] Business/Company  Dashboard (show rating, total review, list of review posted for current company, current membership plan/offering membership, billing history, answering review section for paid membership)
10. [v] Business/Company  Register Form Page
11. [v] Business/Company  Login Form Page
12. [v] Business/Company Profile form page (Company/Brand name, domain site, business email)
13. [v] Write review form page for any Company
14. [v] Write review form page for registered Company 
15. [v] Thank you page for write review page
16. [v] Thank you page for register new company
17. [v] 404 not found page

### Backlog
[x] payment membership process page
[x] sidebar not working
[x] account status need to define after register (user & company)
[] refine logic update active / suspend status in database while updating in admin,check view page , do not using created_at for this field
[x] Admin Dashboard
[x] Edit respond company from company dashboard 
[x] Prohibited respond company while 'IN REVIEW' Status
[x] Delete review from user dashboard
[] See Company respond in admin dashboard
[] Email notification to company after user submit review only for premium membership
[x] CRUD Business Category
[x] Edit Business Category from Company Dashboard
[x] Edit Review type from user dashboard
[x] Email notification to company for Account Activation
[x] Email notification to company after subscription
[] Social Media input in Admin Dashboard

