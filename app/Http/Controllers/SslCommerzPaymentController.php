<?php

namespace App\Http\Controllers;

use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SslCommerzPaymentController extends Controller
{
    public function paymentInfo($plan)
    {
        switch ($plan) {
            case 1:
                $data['subtotal'] = 100;
                $data['planType'] = 'Basic';
                break;
            case 2:
                $data['subtotal'] = 150;
                $data['planType'] = 'Standard';
                break;
            case 3:
                $data['subtotal'] = 200;
                $data['planType'] = 'Premium';
                break;
            default:
                $data['subtotal'] = 10;
        }

        $data['taxPercentage'] = 0.15;
        $data['tax'] = $data['subtotal'] * $data['taxPercentage'];
        $data['total'] = floor($data['subtotal'] + $data['tax']);

        return $data;
    }

    public function index($plan)
    {
        return view('hosted-checkout', [
            'data' =>  $this->paymentInfo($plan),
            'plan' => $plan
        ]);
    }

    public function store(Request $request)
    {
        # Here you have to receive all the order data to initiate the payment.
        # Let's say, your oder transaction information are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction,
        # "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = [];
        $post_data['total_amount'] = $this->paymentInfo($request->plan)['total']; // You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->input('customer_name');
        $post_data['cus_email'] = $request->input('customer_email');
        $post_data['cus_add1'] = $request->input('customer_add1');
        $post_data['cus_add2'] = $request->input('customer_add2'); // nullable
        $post_data['cus_city'] = $request->input('customer_city'); // nullable
        $post_data['cus_state'] = $request->input('customer_state'); // nullable
        $post_data['cus_postcode'] = $request->input('customer_postcode'); // nullable
        $post_data['cus_country'] = $request->input('customer_country');
        $post_data['cus_phone'] = $request->input('customer_phone');
        $post_data['cus_fax'] = ""; // nullable

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        # Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the payment gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }

    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order table against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /**
                 * That means IPN did not work or IPN URL was not set in your merchant panel.
                 * Here you need to update order status in order table as Processing or Complete.
                 * Here you can also sent sms or email for successful transaction to customer
                 */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                return redirect()->route('home')->with('message', 'Transaction is successfully Completed');
            } else {
                /**
                 * That means IPN did not work or IPN URL was not set in your merchant panel and transaction validation failed.
                 * Here you need to update order status as Failed in order table.
                 */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             * That means through IPN Order status already updated.
             * Now you can just show the customer that transaction is completed.
             * No need to update database.
             */
            return redirect()->route('home')->with('message', 'Transaction is successfully Completed');
        } else {
            # That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Failed";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payment information from the gateway
        if ($request->input('tran_id')) #Check transaction id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order table against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but transaction validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to update database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
