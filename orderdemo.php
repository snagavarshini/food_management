<html>
<style>
.order .row{
  padding:2rem;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
  background:#fff;
  display: flex;
  flex-wrap: wrap;
  gap:1.5rem;
  border-radius: .5rem;
}

.order .row .image{
  flex:1 1 30rem;
}

.order .row .image img{
  height: 100%;
  width:100%;
  object-fit: cover;
  border-radius: .5rem;
}

.order .row form{
  flex:1 1 50rem;
  padding:1rem;
}

.order .row form .inputBox{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.order .row form .inputBox input, .order .row form textarea{
  padding:1rem;
  margin:1rem 0;
  font-size: 1.7rem;
  color:#333;
  text-transform: none;
  border:.1rem solid rgba(0,0,0,.3);
  border-radius: .5rem;
  width:49%;
}

.order .row form textarea{
  width:100%;
  resize: none;
  height:15rem;
}

.order .row form .btn{
  background:none;
}

.order .row form .btn:hover{
  background:var(--red);
}

</style>
<section class="order" id="order">





<?php
           if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
              echo $_SESSION['add']; //displaying the session message if set
              unset($_SESSION['add']); //remove session message
            }
           ?> 

    <h1 class="heading"> <span>order</span> now </h1>

    <div class="row">
        
        <div class="image">
            <img src="images/order-img.jpg" alt="">
        </div>

        <form action="" method="POST">

            <div class="inputBox">
                <input type="text" placeholder="name">
                <input type="email" placeholder="email">
            </div>

            <div class="inputBox">
                
                <input type="text" placeholder="Hotel name">
                 <input type="text" placeholder="food name">
            </div>

            <textarea placeholder="address" name="" id="" cols="30" rows="10"></textarea>

            <input type="submit" name="submit" value="order now" class="btn">

        </form>

    </div>

</section>

<!-- order section ends -->
