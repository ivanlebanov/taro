def main():
    runTest("Make Account", "makeAccount.py")
    runTest("Login", "login.py")
    runTest("Log out", "logout.py")
    runTest("Find cheapest laptop", "cheapestLaptop.py")
    runTest("Change address", "changeAddress.py")
    runTest("Similar searches", "similarSearches.py")
    runTest("Add to basket", "addToBasket.py")
    runTest("Empty basket", "emptybasket.py")
    runTest("Laptop comparison", "laptopComparison.py")
    runTest("Checkout", "checkout.py")

def runTest(testName, file):
    print("\nRunning '" + testName + "' Test: ")
    exec(open(file).read(), globals())

if __name__ == "__main__":
    main()
