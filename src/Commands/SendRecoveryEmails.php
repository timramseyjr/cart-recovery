<?php

namespace timramseyjr\CartRecovery\Commands;

use App\Models\Settings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use timramseyjr\CartRecovery\Mail\RecoverCart;
use timramseyjr\CartRecovery\Models\CartRecovery;
use timramseyjr\CartRecovery\Models\CartRecoveryEmail;

class SendRecoveryEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cartrecovery:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Emails after specified time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $settings = Settings::where('module','cart_recovery')->get()->pluck('value','key');
        $message_template = $settings['cart_recovery_email_template'];
        $email_name = $settings['cart_recovery_from_name'];
        $email_address = $settings['cart_recovery_from_email'];
        $subject = $settings['cart_recovery_email_subject'];
        $add_time = $settings['cart_recovery_first_email_time'] ?? config('cart-recovery.first_email_time');
        $send_time = now()->subHours($add_time);
        $emails_to_send = CartRecovery::where('updated_at','<',$send_time)->where('complete',0)->get();
        foreach($emails_to_send as $customer){
            $data = [
                'id' => $customer->id,
                'name' => !empty($customer->name) ? $customer->name.',' : ''
            ];
            $cart = json_decode($customer->cart);
            $items = '<table>';
            foreach($cart->items as $item){
                $items .= '<tr>';
                $items .= '<td><a href="'.config("tld.yahoo_store_url").$item->id.'.html"><img src="'.$item->imageUrl.'" /></a></td>';
                $items .= '<td style="padding-left:40px;"><a style="text-decoration: none; color: #222;" href="'.config("tld.yahoo_store_url").$item->id.'.html">'.$item->name.'</a>';
                if(property_exists($item,'options')){
                    foreach($item->options as $option){
                        $items .= '<br />'.$option->name.':'.$option->value;
                    }
                }
                $items .= '<br /><br /><a style="padding:5px 10px;font-weight: 600;text-transform: uppercase;color: #fff;background: #1e3953; text-decoration: none;" href="'.config("tld.yahoo_store_url").'cart.html?cid='.$customer->id.'">View Cart</a></td>';
                $items .= '</tr>';
            }
            $items .= '</table>';
            $data['items'] = $items;
            $message_template = $this->replaceTemplate($message_template,$data);
            $customer->complete = 1;
            $customer->save();
            Mail::to($customer->email)->send(new RecoverCart($message_template,$email_name,$email_address,$subject));
            $emails = CartRecoveryEmail::firstOrNew(['recovery_id' => $customer->id]);
            $emails->email_number++;
            $emails->email = $message_template;
            $emails->recovery_id = $customer->id;
            $emails->save();
        }
    }
    private function replaceTemplate($content, $data){
        $template = $content;
        if (preg_match_all("/{{(.*?)}}/", $template, $m)) {
            foreach ($m[1] as $i => $varname) {
                if(array_key_exists($varname, $data)) {
                    $template = str_replace($m[0][$i], sprintf('%s',$data[$varname]), $template);
                }
            }
        }
        return $template;
    }
}
