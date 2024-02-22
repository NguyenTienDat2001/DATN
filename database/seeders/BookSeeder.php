<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('books')->insert([
            ['name'=>'Moriarty The Patriot - Tập 2' ,'description'=>'Vào thế kỷ 19, đế chế Anh quốc áp đặt sự thống trị của mình bao trùm khắp thế giới. Tầng lớp quý tộc tự cho mình những đặc ân chưa từng thấy, khiến hố ngăn giai cấp ngày càng bị đào sâu.

            Sinh ra trong một gia đình quý tộc như thế, nhưng Albert James Moriarty cảm thấy chán ghét chính dòng máu đang chảy trong người mình, và trong một lần thăm cô nhi viện, cậu đã tìm thấy hai đứa trẻ cùng chung lý tưởng. Cậu quyết định nhận nuôi cả hai, bước đầu tiên đưa William James Moriarty bước lên vũ đài, với khát khao thay đổi thế giới, mang lại một cuộc sống tươi đẹp hơn cho nhân loại.', 'category'=>'Truyện tranh', 'buy_price'=>35000, 'sell_price'=>45000, 'author'=>'Ryosuke Takeuchi', 'age'=>4, 'published_at'=>2023, 'publisher'=>'Hà Nội', 'count'=>65, 'totalsale'=>38, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/n/x/nxbtre_full_13272023_032714.jpg', ],
            ['name'=>'Chú Thuật Hồi Chiến - Tập 18: Nhiệt - Tặng Kèm Obi + Thẻ Bo Góc Nhựa' ,'description'=>'Để nhờ đàn anh năm 3 trường chuyên chú thuật hiện đang bị đình chỉ là Hakari Kinji hợp sức trấn áp “Tử Diệt Hồi Du”, Itadori đã tham gia trận đấu đặt cược do anh ta chủ trì và thử thương lượng trực tiếp. Fushiguro cũng đã thâm nhập và đang trên đường tới căn cứ, nhưng lại bị một thuật sư năm 3 đi cùng Hakari cản trở!!?', 'category'=>'Truyện tranh', 'buy_price'=>18500, 'sell_price'=>28500, 'author'=>'Gege Akutami', 'age'=>2, 'published_at'=>2023, 'publisher'=>'Kim Đồng', 'count'=>81, 'totalsale'=>57, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/c/h/chu-thuat-hoi-chien_ban-thuong_mockup_tap-18.jpg', ], 
            ['name'=>'Slam Dunk - Deluxe Edition - Tập 17 - Tặng Kèm Obi + Bìa Áo Limited Ngẫu Nhiên' ,'description'=>'Giành thắng lợi trong trận tử chiến với Ryonan, cuối cùng Shohoku cũng chiếm được suất tham dự giải bóng rổ của các trường cấp ba trên toàn quốc. Tuy nhiên, đối thủ của họ bây giờ sẽ là những đội bóng cực mạnh đến từ khắp mọi miền. Để chuẩn bị cho giải toàn quốc, Shohoku bắt đầu bước vào một đợt tập huấn tăng cường cực nặng…!?

TRỌN BỘ 24 TẬP HOÀNH TRÁNG!!

Phiên bản nâng cấp với phần bìa được vẽ mới!!

Bổ sung đầy đủ các trang màu từ tạp chí!!', 'category'=>'Truyện tranh', 'buy_price'=>50000, 'sell_price'=>60000, 'author'=>'Takehiko Inoue', 'age'=>4, 'published_at'=>2021, 'publisher'=>'Trẻ', 'count'=>93, 'totalsale'=>68, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/s/l/slam_dunk_deluxe_edition_bia_tap_17.jpg', ],
            ['name'=>'BlueLock - Tập 17 - Tặng Kèm Card PVC' ,'description'=>'NÀO, TIẾN TỚI KỈ NGUYÊN MỚI CỦA BÓNG ĐÁ NHẬT BẢN!! 

NHỮNG CÁI TÔI SẼ MỞ RA CÁNH CỬA ẤY!!', 'category'=>'Truyện tranh', 'buy_price'=>25000, 'sell_price'=>35000, 'author'=>'Muneyuki Kaneshiro, Yusuke', 'age'=>3, 'published_at'=>2021, 'publisher'=>'Kim Đồng', 'count'=>45, 'totalsale'=>98, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/b/l/bluelock_bia_tap_17.jpg', ],
            ['name'=>'BlueLock - Tập 18 - Tặng Kèm Card PVC' ,'description'=>'GIAI ĐOẠN 2 CỦA DỰ ÁN BLUELOCK BẮT ĐẦU! 

NHỮNG CÁI TÔI CỦA CHÚNG TA TIẾN TỚI ĐẤU TRƯỜNG RỘNG LỚN HƠN!!', 'category'=>'Truyện tranh', 'buy_price'=>25000, 'sell_price'=>35000, 'author'=>'Muneyuki Kaneshiro, Yusuke', 'age'=>3, 'published_at'=>2023, 'publisher'=>'Hà Nội', 'count'=>52, 'totalsale'=>58, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/b/l/bluelock_bia_tap_18.jpg', ],
            ['name'=>'Soul Eater - Perfect Edition - Tập 2' ,'description'=>'Câu chuyện kể về cuộc phiêu lưu của Maka Albarn và vũ khí lưỡi hái khổng lồ của cô, Soul Eater. Khi đang làm nhiệm vụ ở Ý, cả hai bị vướng vào những âm mưu của mụ phù thủy Medusa, đó là hồi sinh Kishin, một sinh vật điên loạn sẽ hóa thành ác quỷ sau khi tiêu thụ linh hồn của người vô tội. Sau trận chiến dữ dội với đứa con của Medusa, Crona, Maka và Soul trở về Thành phố Chết và hợp tác với các đối thủ là Black Star và Death the Kid để chiến đấu chống lại Medusa.', 'category'=>'Truyện tranh', 'buy_price'=>85000, 'sell_price'=>95000, 'author'=>'Atsushi Ohkubo', 'age'=>2, 'published_at'=>2021, 'publisher'=>'Trẻ', 'count'=>75, 'totalsale'=>72, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/n/x/nxbtre_full_18542023_035437_1.jpg', ], 
            ['name'=>'Banana Fish - Tập 9 - Tặng Kèm Postcard Giấy' ,'description'=>'Câu chuyện xảy ra ở New York những năm 80, kể về một chàng trai trẻ tên Ash Lynx. Ash là thủ lĩnh của một băng đảng đường phố. Cậu được một ông trùm mafia là “Papa” Dino Golzine nuôi dưỡng thành tay sai và đồ chơi tình dục của lão. Do căm ghét Dino và khát khao tự do, Ash đã chạy trốn và sống lang thang cùng đám đàn em của mình. Chẳng ngờ trong một lần tình cờ cậu lại nắm được một bí mật lớn có thể làm rung chuyển thế giới ngầm của “Papa”.', 'category'=>'Truyện tranh', 'buy_price'=>35000, 'sell_price'=>45000, 'author'=>'Akimi Yoshida', 'age'=>4, 'published_at'=>2022, 'publisher'=>'Kim Đồng', 'count'=>79, 'totalsale'=>87, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/n/x/nxbtre_full_13282023_032806_1.jpg', ], 
            ['name'=>'Moriarty The Patriot - Tập 1' ,'description'=>'Vào thế kỷ 19, đế chế Anh quốc áp đặt sự thống trị của mình bao trùm khắp thế giới. Tầng lớp quý tộc tự cho mình những đặc ân chưa từng thấy, khiến hố ngăn giai cấp ngày càng bị đào sâu.

Sinh ra trong một gia đình quý tộc như thế, nhưng Albert James Moriarty cảm thấy chán ghét chính dòng máu đang chảy trong người mình, và trong một lần thăm cô nhi viện, cậu đã tìm thấy hai đứa trẻ cùng chung lý tưởng. Cậu quyết định nhận nuôi cả hai, bước đầu tiên đưa William James Moriarty bước lên vũ đài, với khát khao thay đổi thế giới, mang lại một cuộc sống tươi đẹp hơn cho nhân loại.', 'category'=>'Truyện tranh', 'buy_price'=>35000, 'sell_price'=>45000, 'author'=>'Ryosuke Takeuchi, Hikaru Miyoshi', 'age'=>2, 'published_at'=>2023, 'publisher'=>'Kim Đồng', 'count'=>71, 'totalsale'=>99, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/n/x/nxbtre_full_27332023_033315.jpg', ],
            ['name'=>'Bộ Manga Hắc Quản Gia - Tập 1 + Tập 2 (Bộ 2 Cuốn) - Tặng Kèm 2 Black Card + 1 Kẹp File Dark Moon' ,'description'=>'Thân là quản gia, chút chuyện cỏn con này cũng không lo được thì còn làm nên trò trống gì?

Dòng họ quý tộc Phantomhive danh giá Anh quốc có một chàng quản gia toàn năng, tên gọi ""Sebastian"". Học cao hiểu rộng, phẩm cách thanh cao, tinh thông ẩm thực, võ nghệ cao cường… Chiếc áo đuôi tôm đen tuyền không ngừng lay động trước mặt vị chủ nhân 12 tuổi tùy hứng.

Trân trọng gửi tới độc giả bộ truyện tranh về quản gia thích hợp để thưởng thức cùng hồng trà nhất thế gian…', 'category'=>'Truyện tranh', 'buy_price'=>106000, 'sell_price'=>116000, 'author'=>'Toboso Yana', 'age'=>3, 'published_at'=>2023, 'publisher'=>'Trẻ', 'count'=>42, 'totalsale'=>31, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/h/a/hac_quan_gia_2_bia_1_2.jpg', ],
            ['name'=>'Dragon Quest - Dấu Ấn Roto - Những Người Kế Thừa - Tập 9 - Tặng Kèm Postcard' ,'description'=>'Nhóm Aros được mời tới Vương cung và nắm được vài thông tin về viên ngọc mới cùng một số điều kiện trao đổi. Điều kiện đó rốt cuộc là gì!?

Mặt khác, sự thật về “câu chuyện đau khổ không dứt” đằng sau mối quan hệ giữa Ramia và Anis cũng được hé lộ.

Câu chuyện về những con người được đưa đường chỉ lối đã bước vào tập 9.', 'category'=>'Truyện tranh', 'buy_price'=>30000, 'sell_price'=>40000, 'author'=>'Kamui Fujiwara', 'age'=>2, 'published_at'=>2021, 'publisher'=>'Lao động', 'count'=>91, 'totalsale'=>39, 'img'=>'https://cdn0.fahasa.com/media/catalog/product/d/r/dragon_quest_dau_an_roto_nhung_nguoi_ke_thua_bia_tap_9.jpg', ],

        ]);
    }
}
