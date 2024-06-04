<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign up today! | Gadget Groove</title>
  </head>
  <body>
    <div class="body">
    <section class="container">
      <header>Sign Up </header><p>It’s quick and easy.</p>
      <form action="process_register.php" method="post" class="form">
      <div class="column">
        <div class="input-box">
          <label for="firstname">First Name</label>
          <input name ="firstname" id="firstname" type="text" placeholder="Enter first name" required />
        </div>
        <div class="input-box">
          <label for="lastname" >Last Name</label>
          <input name ="lastname" id="lastname" type="text" placeholder="Enter last name" required />
        </div>
      </div>
      <div class="column">
        <div class="input-box">
          <label for="contactnumber">Phone Number</label>
          <input name="contactnumber" id="contactnumber" type="number" placeholder="Enter phone number" required />
        </div>
        <div class="input-box">
          <label for="birthdate">Birth Date</label>
          <input name="birthdate" id="birthdate" type="date" placeholder="Enter birth date" required />
        </div>
      </div>

      <div class="gender-box">
        <h3>Gender</h3>
        <div class="gender-option">
        <div class="gender">
          <input type="radio" id="male" name="gender" value="m" />
          <label for="male">Male</label>
        </div>
        <div class="gender">
          <input type="radio" id="female" name="gender" value="f" />
          <label for="female">Female</label>
        </div>
        <div class="gender">
           <input type="radio" id="other" name="gender" value="o" />
          <label for="other">prefer not to say</label>
        </div>
        </div>
      </div>

        <div class="input-box address">
          <label for="address" >Address</label>
          <input name="address" id= "address" type="text" placeholder="Enter street address" required />
          <div class="column">
            <input name="country" type="text" placeholder="Enter your Country" required/>
            <input name="zone" type="number" placeholder="Enter zone number" required />
          </div>
          <div class="column">
            <input name= "region" type="text" placeholder="Enter region" required />
            <input name= "postalcode" type="number" placeholder="Enter postal code" required />
          </div>
        <div class="input-box">
         <label for="username" >Username</label>
         <input name= "username" id="username" type="text" placeholder="Enter Username" required />
        </div>
        <div class="input-box">
          <label for="email" >Email</label>
          <input name="email" id="email" type="email" placeholder="Enter email" required />
        </div>
        <div class="input-box">
          <label for="password" >Password</label>
          <input name="password" id="password" type="password" placeholder="Enter password" required />
        </div>
        <div class="input-box">
            <label for="user_type">User Type</label>
            <select name="user_type" id="user_type" required>
                <option value="">Select user type</option>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
              </select>
          </div>

        </div>
        <button type="submit">Submit</button>
        <div class="link1">
            Already have an account? <a href="login.php">Sign In</a>
      </form>

      
    </section>
    </div>
  </body>
</html>