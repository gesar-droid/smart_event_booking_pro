# Test Evidence Table - Smart Event Booking Pro

Save screenshots in `/docs/screenshots/` using the test case ID in the filename.

| TC ID | Feature | Scenario | Expected Result | Status |
|---|---|---|---|---|
| TC01 | Login | Admin logs in with valid credentials | Admin dashboard opens | Pass |
| TC02 | Login | Incorrect password entered | Login denied with error message | Pass |
| TC03 | Register | New user registers with valid data | Account created and password hashed | Pass |
| TC04 | Role Access | Standard user opens admin URL | Access denied or redirected | Pass |
| TC05 | Event CRUD | Admin creates event | Event saved and displayed | Pass |
| TC06 | Event Validation | Empty required field submitted | Validation error shown | Pass |
| TC07 | Event Update | Admin edits event details | Updated data displayed | Pass |
| TC08 | Event Delete | Admin deletes test event | Event removed or deactivated | Pass |
| TC09 | Search/Filter | User searches by title or venue | Matching events displayed | Pass |
| TC10 | Booking | User books tickets | Pending booking created | Pass |
| TC11 | Booking Validation | Invalid ticket quantity entered | Request rejected | Pass |
| TC12 | AI Assistant | User asks help question | Curated response and disclaimer shown | Pass |
| TC13 | Responsive UI | Pages tested on mobile width | Layout remains usable | Pass |
| TC14 | Activity Log | Admin performs key action | Action recorded with timestamp | Pass |
