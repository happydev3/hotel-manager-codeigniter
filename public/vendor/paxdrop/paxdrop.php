<!DOCTYPE html>
<html>
    <head id="Head1">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="pax_drop.css">
    </head>
    <body>
        <div class="col-sm-3 padd-l0 pax_drop">
            <div class="form-group">
                <label for="">No of Guests</label>
                <!-- <input type="text" placeholder="1 adult, Economy" class="form-control c-round c-theme" id="travellers-hotel"> -->
                <span class="form-control c-round c-theme travellers-input" id="travellers-hotel">
                    <span class="adultsF travellers-input">1</span> adult,
                    <span class="childsF travellers-input">0</span> child,
                    <span class="room_countF travellers-input">1</span> Room
                </span>
            </div>
            <div class="travellers-input-popup" id="travellers-hotel-popup">
                <i class="fa fa-times" aria-hidden="true"></i>
                <label>Occupancy</label>
                <div class="trip-options">
                    <p>Room - <span>1</span></p>
                    <div class="numstepper">
                        <button type="button" class="quantity-btn quantity-left-minus btn-number-rooms"  data-type="minus" data-field="room_count"></button>
                        <input type="text" name="room_count" class="quantity-input input-number multi" value="1" min="1" max="4">
                        <button type="button" class="quantity-btn quantity-right-plus btn-number-rooms" data-type="plus" data-field="room_count"></button>
                    </div>
                    <div class="clone-room">
                        <p class="rooms" style="display: none;">Room - <span>2</span></p>
                        <p>Adults</p>
                        <div class="numstepper">
                            <button type="button" class="quantity-btn quantity-left-minus btn-number-arr" data-type="minus" data-field="adults">
                            </button>
                            <input type="text" name="adults[]" class="quantity-input input-number adults" value="1" min="1" max="3">
                            <button type="button" class="quantity-btn quantity-right-plus btn-number-arr" data-type="plus" data-field="adults">
                            </button>
                        </div>
                        <p>Children</p>
                        <div class="clone-item roomage">
                            <input type="hidden" class="roomsno" value="1">
                            <p style="display: none;">Childage - <span>1</span></p>
                            <div class="numstepper">
                                <button type="button" class="quantity-btn quantity-left-minus btn-number-multi roomAge" data-type="minus" data-field="childs">
                                </button>
                                <input type="text" name="childs[]" class="quantity-input input-number multi childs" value="0" min="0" max="3">
                                
                                <button type="button" class="quantity-btn quantity-right-plus btn-number-multi roomAge" data-type="plus" data-field="childs">
                                </button>
                            </div>
                        </div>
                        <div class="clonediv"></div>
                    </div>
                    <div class="clonediv-room"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script src="http://cdn.jsdelivr.net/bootstrap/3/js/bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="pax_drop.js"></script>
    </body>
</html>