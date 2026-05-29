<?php
if (isset($current_item) && isset($user)) {
    if ($current_item->user_requesting_id == $user) {
        $myBookId = $current_item->request_book_id;
        $partnerBookId = $current_item->offer_book_id;
        $partner_id = $current_item->user_offering_id;
    } else {
        $myBookId = $current_item->offer_book_id;
        $partnerBookId = $current_item->request_book_id;
        $partner_id = $current_item->user_requesting_id;
    }
}