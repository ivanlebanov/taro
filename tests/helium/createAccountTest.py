

from helium.api import *
from time import sleep

# start the site and maximise the window
start_chrome("localhost:8000")
get_driver().maximize_window()

# Fill the form on the registration page with given values.
def fillRegForm(name, email, password1, password2):
    write(name, into="Name")
    write(email, into="Email")
    write(password1, into="Password")
    write(password2, into="Confirm Password")
    click("Register")

def testRegForm(testName, name, email, password1, password2, failureMessage):
    fillRegForm(name, email, password1, password2)
    if(not Text("The following errors have occurred:").exists()):
        print(failureMessage)
    else:
        print(testName, "- passed")

# Get to registration page
click("Login / Register")
click("Don't have an account? Register")

#Test case variables
testEmail = "email@address.test"
testPass = "password"

# TEST CASES
testRegForm("Empty form", "", "", "", "", "An empty form should give an error message!")
testRegForm("Missing name", "", testEmail, testPass, testPass, "Missing 'Name' field should give error!")
testRegForm("Missing email", "Name", "", testPass, testPass, "Missing 'Email' field should give error!")
testRegForm("Missing first password", "Name", testEmail, "", testPass, "Missing 'Password' field should give error!")
testRegForm("Missing second password", "Name", testEmail, testPass, "", "Missing 'Password' field should give error!")
testRegForm("Mismatched password", "Name", testEmail, testPass, "notthepassword", "Mismatched passwords should give an error")

# Close the browser window after testing is completed
kill_browser()
print("Finished testing.")
