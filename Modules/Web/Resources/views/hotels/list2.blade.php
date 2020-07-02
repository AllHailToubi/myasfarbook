
<style>

    .shadow-me {
        box-shadow: 0 1px 6px 0px rgba(0,0,0,0.15);
        transition: all 0.3s ease-in-out;
    }
    .shadow-me:hover {
        box-shadow: 0 1px 13px 0px rgba(0,0,0,0.3);
        transition: opacity 0.3s ease-in-out;
    }
    .box-me{
        //height: 190px;
    }

    .imgbox{
        display: inline-flex;
    }

    .imgbox img{
        
        width: 249px;
        height: 190px;
    }

    .red{
        display: inline-block;
        width: 250px;
        height: 190px;
        background: red;
    }

    .green{
        display: inline-block;
        width: 50px;
        height: 190px;
        background: green;
    }

    .blue{
        display: inline-block;
        float: right;
        width: 160px;
        height: 190px;
        background: blue;
    }


</style>
    
<div class="hotel-list listing-style3 hotel">
    @foreach($hotels as $hotel)
        <div class="border bg-white my-3 shadow-me p-2">
           <div class="imgbox"><img src="https://pix6.agoda.net/hotelImages/617/6176/6176_15012120270024747300.jpg?s=450x450" alt="" srcset=""></div>
           <div class="green"></div>
           <div class="blue"></div>
        </div>
    
    @endforeach
    
    
</div>

    
  