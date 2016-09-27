<?php

namespace app\models;

use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "cases".
 *
 * @property integer $case_id
 * @property integer $uid
 * @property integer $doctor_id
 * @property integer $type
 * @property string $name
 * @property integer $gender
 * @property integer $age
 * @property string $address
 * @property string $relation_contact
 * @property string $deaf_date
 * @property string $can_listen
 * @property string $hard_case
 * @property integer $deaf_side
 * @property string $treat_result
 * @property integer $weared
 * @property integer $weared_side
 * @property integer $aid_type
 * @property string $left_type
 * @property string $right_type
 * @property integer $effect
 * @property integer $er_ming
 * @property integer $xuan_yun
 * @property integer $er_tong
 * @property integer $fen_mi_wu
 * @property integer $operation_history
 * @property integer $zao_yin
 * @property integer $wai_shang
 * @property string $family_history
 * @property string $person_history
 * @property string $ill_condition
 * @property string $cure_condition
 * @property string $toxic
 * @property integer $use_medicine
 * @property string $medicine
 * @property string $allergy
 * @property string $kan_hua
 * @property string $intelligent
 * @property string $mental
 * @property string $remark
 * @property integer $left_er_kuo
 * @property integer $right_er_kuo
 * @property integer $left_er_dao
 * @property integer $right_er_dao
 * @property integer $left_gu_mo
 * @property integer $right_gu_mo
 * @property integer $left_ru_tu
 * @property integer $right_ru_tu
 * @property string $left_ce_ting
 * @property string $right_ce_ting
 * @property string $ctime
 * @property array $canHearName
 * @property array $hardCaseName
 * @property array $illName
 * @property array $toxicName
 * @property string $ceting_img_left
 * @property string $ceting_img_right
 */
class Cases extends \yii\db\ActiveRecord
{
    const TYPE_ADULT = 1;
    const TYPE_CHILD = 2;
    public static $types = [
        self::TYPE_ADULT => '成人',
        self::TYPE_CHILD => '儿童',
    ];

    public static $deaf_statuses = [
        1 => '自幼听力言语障碍',
        2 => '自幼听力正常，言语障碍',
        3 => '自幼言语不清，听力略障碍',
        4 => '出生后听力正常，后听力逐渐障碍',
    ];

    public static $home_trains = [
        1 => '从未训练过',
        2 => '聋校',
    ];

    public static $renshen = [
        1 => '轻',
        2 => '中',
        3 => '重',
        4 => '无反应',
    ];

    const CAN_HEAR_THUNDER = 1;
    const CAN_HEAR_FIRECRACKER = 2;
    const CAN_HEAR_TRUMPET = 3;
    const CAN_HEAR_SHOUT = 4;
    const CAN_HEAR_CLAP = 5;
    const CAN_HEAR_TALK = 6;
    public static $canHear = [
        self::CAN_HEAR_THUNDER => '打雷声',
        self::CAN_HEAR_FIRECRACKER => '鞭炮声',
        self::CAN_HEAR_TRUMPET => '汽车喇叭声',
        self::CAN_HEAR_SHOUT => '大声说',
        self::CAN_HEAR_CLAP => '拍手声',
        self::CAN_HEAR_TALK => '普通讲话声',
    ];

    const HARD_CASE_ONE = 1;
    const HARD_CASE_FAMILY = 2;
    const HARD_CASE_CLASS = 3;
    const HARD_CASE_DISCUSS = 4;
    const HARD_CASE_OUTDOOR = 5;
    const HARD_CASE_THEATER = 6;
    const HARD_CASE_TV = 7;
    const HARD_CASE_PHONE = 8;
    public static $hardCase = [
        self::HARD_CASE_ONE => '一对一的交流',
        self::HARD_CASE_FAMILY => '安静的家里',
        self::HARD_CASE_CLASS => '课堂回答问题',
        self::HARD_CASE_DISCUSS => '课堂上集体讨论',
        self::HARD_CASE_OUTDOOR => '嘈杂环境下的户外活动',
        self::HARD_CASE_THEATER => '影剧院里',
        self::HARD_CASE_TV => '看电视',
        self::HARD_CASE_PHONE => '听电话',
    ];

    const EAR_LEFT = 1;
    const EAR_RIGHT = 2;
    const EAR_BOTH = 3;
    public static $earSide = [
        self::EAR_LEFT => '左耳',
        self::EAR_RIGHT => '右耳',
        self::EAR_BOTH => '双耳',
    ];

    const AID_TYPE_SIMULATE = 1;
    const AID_TYPE_PROGRAM = 2;
    const AID_TYPE_DIGITAL = 3;
    public static $aidType = [
        self::AID_TYPE_SIMULATE => '模拟机',
        self::AID_TYPE_PROGRAM => '数码编程机',
        self::AID_TYPE_DIGITAL => '全数字机',
    ];

    const EFFECT_GOOD = 1;
    const EFFECT_COMMON = 2;
    const EFFECT_BAD = 3;
    public static $effects = [
        self::EFFECT_GOOD => '好',
        self::EFFECT_COMMON => '一般',
        self::EFFECT_BAD => '没效',
    ];

    const HAS_YES = 1;
    const HAS_NO = 2;
    public static $has = [
        self::HAS_YES => '有',
        self::HAS_NO => '无',
    ];

    const ER_KUO_NORMAL = 1;
    const ER_KUO_WRONG = 2;
    public static $erKuo = [
        self::ER_KUO_NORMAL => '正常',
        self::ER_KUO_WRONG => '畸形',
    ];

    const ER_DAO_GOOD = 1;
    const ER_DAO_BAD = 2;
    const ER_DAO_OUT = 3;
    public static $erDao = [
        self::ER_DAO_GOOD => '通畅',
        self::ER_DAO_BAD => '耵聍',
        self::ER_DAO_OUT => '分泌物',
    ];

    const GU_MO_GOOD = 1;
    const GU_MO_XIAN = 2;
    const GU_MO_ZHAN = 3;
    const GU_MO_XUE = 4;
    const GU_MO_CHUAN = 5;
    public static $guMo = [
        self::GU_MO_GOOD => '完整',
        self::GU_MO_XIAN => '内陷',
        self::GU_MO_ZHAN => '粘连',
        self::GU_MO_XUE => '充血',
        self::GU_MO_CHUAN => '穿孔',
    ];

    const RU_TU_GOOD = 1;
    const RU_TU_RED = 2;
    const RU_TU_PAIN = 3;
    public static $ruTu = [
        self::RU_TU_GOOD => '正常',
        self::RU_TU_RED => '红肿',
        self::RU_TU_PAIN => '压痛',
    ];

    public $left_ce_tingFile = null;
    public $right_ce_tingFile = null;
    public $ceting_img_left = null;
    public $ceting_img_right = null;

    public $canHears = [];
    public $hardCases = [];
    public $ills = [];
    public $toxics = [];
    public $mother_toxics = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'doctor_id', 'gender', 'deaf_side', 'weared', 'weared_side', 'aid_type', 'effect', 'er_ming',
                'xuan_yun', 'er_tong', 'fen_mi_wu', 'operation_history', 'zao_yin', 'wai_shang', 'use_medicine',
                'left_er_kuo', 'right_er_kuo', 'left_er_dao', 'right_er_dao', 'left_gu_mo', 'right_gu_mo', 'left_ru_tu',
                'right_ru_tu', 'type', 'father_age', 'mother_age', 'deaf_status', 'home_train', 'gaoxueya', 'renshenfanying',
                'shunchan', 'zaochan', 'birth_month', 'nanchan', 'zhuchan', 'yinchan', 'paofuchan', 'queyang', 'tizhong', 'raojing'], 'integer'],
            [['ctime', 'canHears', 'hardCases', 'ills', 'toxics', 'mother_toxics', 'ceting_img_left', 'ceting_img_right',
                'chun_yin_left' , 'sa_left', 'tpp_left', 'gushi_type_left', 'ceshi_qiangdu_left', 'shibie_rate_left', 'xinzao_left', 'cibiao_left', 'jixing1_left', 'xiaoguo1_left', 'remark1_left', 'jixing2_left', 'xiaoguo2_left', 'remark2_left',
                'chun_yin_right' , 'sa_right', 'tpp_right', 'gushi_type_right', 'ceshi_qiangdu_right', 'shibie_rate_right', 'xinzao_right', 'cibiao_right', 'jixing1_right', 'xiaoguo1_right', 'remark1_right', 'jixing2_right', 'xiaoguo2_right', 'remark2_right',
            ], 'safe'],
            [['name', 'can_listen', 'hard_case', 'left_type', 'right_type', 'father_name'], 'string', 'max' => 200],
            [['deaf_date', 'address', 'treat_result', 'family_history', 'person_history', 'ill_condition', 'cure_condition', 'toxic',
                'medicine', 'allergy', 'kan_hua', 'intelligent', 'mental', 'remark', 'left_ce_ting', 'right_ce_ting',
                'father_occupation', 'father_edu', 'father_hear', 'mother_name', 'mother_occupation', 'mother_edu', 'mother_hear',
                'school', 'mother_ill_history', 'mother_toxic', 'mother_medicine', 'baotaiyao', 'renshen_hurt', 'renshen_ill'],
                'string', 'max' => 500],
            [['left_ce_tingFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
            [['right_ce_tingFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 10],
            [['relation_contact'], 'string', 'max' => 1000],
            ['age', 'integer', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'case_id' => '病历ID',
            'uid' => '用户',
            'doctor_id' => '验配师',
            'type' => '类型',
            'name' => '病人名字',
            'gender' => '性别',
            'genderName' => '性别',
            'age' => '年龄',
            'address' => '居住地址',
            'relation_contact' => '家属姓名和联系方式',
            'deaf_date' => '耳聋时间',
            'can_listen' => '对何种声音可以听见',
            'canHears' => '对何种声音可以听见',
            'hard_case' => '交流困难的情况',
            'hardCases' => '交流困难的情况',
            'deaf_side' => '受损耳',
            'treat_result' => '曾去何地诊治及诊断结果',
            'weared' => '是否佩戴过助听器',
            'weared_side' => '佩戴边',
            'aid_type' => '助听器类型',
            'left_type' => '左耳型号',
            'right_type' => '右耳型号',
            'effect' => '效果',
            'er_ming' => '耳鸣情况',
            'xuan_yun' => '眩晕情况',
            'er_tong' => '耳痛情况',
            'fen_mi_wu' => '耳分泌物情况',
            'operation_history' => '耳部手术史情况',
            'zao_yin' => '噪音暴露',
            'wai_shang' => '头部外伤史',
            'family_history' => '家族病史',
            'person_history' => '个人病史',
            'ill_condition' => '患病情况',
            'ills' => '患病情况',
            'cure_condition' => '治疗情况',
            'toxic' => '中毒史',
            'toxics' => '中毒史',
            'use_medicine' => '是否服药',
            'medicine' => '服用的药物',
            'allergy' => '过敏史',
            'kan_hua' => '看话能力',
            'intelligent' => '智力情况',
            'mental' => '心理情况',
            'remark' => '备注',
            'left_er_kuo' => '左耳廓',
            'right_er_kuo' => '右耳廓',
            'left_er_dao' => '左耳道',
            'right_er_dao' => '右耳道',
            'left_gu_mo' => '左鼓膜',
            'right_gu_mo' => '右鼓膜',
            'left_ru_tu' => '左乳突',
            'right_ru_tu' => '右乳突',
            'left_ce_ting' => '左耳测听',
            'left_ce_tingFile' => '左耳测听',
            'right_ce_ting' => '右耳测听',
            'right_ce_tingFile' => '右耳测听',
            'ctime' => '创建时间',
            'chun_yin_right'=>'右耳纯音',
            'sa_right'=>'右耳SA',
            'tpp_right'=>'右耳TPP',
            'gushi_type_right'=>'右耳鼓室类型',
            'ceshi_qiangdu_right'=>'右耳测试响度',
            'shibie_rate_right'=>'右耳百分比',
            'xinzao_right'=>'右耳信噪比',
            'cibiao_right'=>'右耳词表',
            'jixing1_right'=>'右耳 机型一',
            'xiaoguo1_right'=>'右耳 试听效果一',
            'remark1_right'=>'右耳 备注一',
            'jixing2_right'=>'右耳 机型二',
            'xiaoguo2_right'=>'右耳 试听效果二',
            'remark2_right'=>'右耳 备注二',
            'chun_yin_left'=>'左耳纯音',
            'sa_left'=>'左耳SA',
            'tpp_left'=>'左耳TPP',
            'gushi_type_left'=>'左耳鼓室类型',
            'ceshi_qiangdu_left'=>'左耳测试响度',
            'shibie_rate_left'=>'左耳百分比',
            'xinzao_left'=>'左耳信噪比',
            'cibiao_left'=>'左耳词表',
            'jixing1_left'=>'左耳 机型一',
            'xiaoguo1_left'=>'左耳 试听效果一',
            'remark1_left'=>'左耳 备注一',
            'jixing2_left'=>'左耳 机型二',
            'xiaoguo2_left'=>'左耳 试听效果二',
            'remark2_left'=>'左耳 备注二',
            'father_name' => '父亲姓名',
            'father_age' => '父亲年龄',
            'father_occupation' => '父亲职业',
            'father_edu' => '父亲文化程度',
            'father_hear' => '父亲听力情况',
            'mother_name' => '母亲名字',
            'mother_age' => '母亲年龄',
            'mother_occupation' => '母亲职业',
            'mother_edu' => '母亲文化程度',
            'mother_hear' => '母亲听力情况',
            'deaf_status' => '幼时耳聋情况',
            'school' => '语言训练机构',
            'home_train' => '家庭训练情况',
            'mother_ill_history' => '母亲传染病史',
            'mother_toxic' => '母亲耳中毒药物史',
            'mother_toxics' => '母亲耳中毒药物史',
            'mother_medicine' => '母亲用药情况',
            'baotaiyao' => '保胎药情况',
            'gaoxueya' => '高血压情况',
            'renshenfanying' => '妊娠反应情况',
            'renshen_hurt' => '妊娠外伤史',
            'renshen_ill' => '妊娠期其他疾病',
            'shunchan' => '足月顺产',
            'zaochan' => '早产',
            'birth_month' => '生产月份',
            'nanchan' => '难产',
            'zhuchan' => '助产',
            'yinchan' => '引产',
            'paofuchan' => '剖腹产',
            'queyang' => '生产时缺氧',
            'tizhong' => '孩子体重',
            'raojing' => '脐带绕颈',
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['uid' => 'doctor_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['uid' => 'uid']);
    }

    public function beforeSave($insert)
    {
        if (!is_null($this->canHears) && !isset($this->dirtyAttributes['can_listen'])){
            $this->can_listen = $this->array2str($this->canHears);
        }
        if (!is_null($this->hardCases) && !isset($this->dirtyAttributes['hard_case'])) {
            $this->hard_case = $this->array2str($this->hardCases);
        }
        if (!is_null($this->ills) && !isset($this->dirtyAttributes['ill_condition'])) {
            $this->ill_condition = $this->array2str($this->ills);
        }
        if (!is_null($this->toxics) && !isset($this->dirtyAttributes['toxic'])) {
            $this->toxic = $this->array2str($this->toxics);
        }
        if (!is_null($this->mother_toxics) && !isset($this->dirtyAttributes['mother_toxic'])) {
            $this->mother_toxic = $this->array2str($this->mother_toxics);
        }

        foreach ($this->validators as $item) {
            $reflect = new \ReflectionClass($item);
            if ($reflect->getShortName() == 'ImageValidator') {
                foreach ($item->attributes as $key) {
                    $url_key = str_replace('File', '', $key);
                    $this->$key = UploadedFile::getInstance($this, $key);
                    if ($this->$key && $this->validate([$key], false)) {
                        $file = "/upload/" . md5($this->$key->baseName . rand(100, 999))
                            . '.' . $this->$key->extension;
                        $this->$url_key = $file;
                        $this->$key->saveAs(Yii::getAlias('@webroot') . $file);
                    }
                }
            }
        }

        if (!is_null($this->ceting_img_left)) {
            if ($file = $this->saveRawImg($this->ceting_img_left)) {
                $this->left_ce_ting = $file;
            }
        }

        if (!is_null($this->ceting_img_right)) {
            if ($file = $this->saveRawImg($this->ceting_img_right)) {
                $this->right_ce_ting = $file;
            }
        }

        return parent::beforeSave($insert);
    }

    private function saveRawImg($data){
        $ext = '';
        $t = explode(';', $data);
        if (strstr($t[0], 'jpeg') !== false || strstr($t[0], 'jpg') !== false) {
            $ext = 'jpg';
        }
        if (strstr($t[0], 'png') !== false) {
            $ext = 'png';
        }
        if ($ext) {
            $file = "/upload/" . md5(strval(time()) . rand(100, 999)) . '.' . $ext;
            $t = explode(',', $data);
            file_put_contents(Yii::getAlias('@webroot') . $file, base64_decode($t[1]), LOCK_EX);
            return $file;
        }
        return false;
    }

    private function array2str($a)
    {
        return is_array($a) ? implode(',', $a) : $a;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->canHears = explode(',', $this->can_listen);
        $this->hardCases = explode(',', $this->hard_case);
        $this->ills = explode(',', $this->ill_condition);
        $this->toxics = explode(',', $this->toxic);
        $this->mother_toxics = explode(',', $this->mother_toxic);
    }

    public function getCanHearName()
    {
        $r = [];
        foreach ($this->canHears as $item) {
            if (isset(self::$canHear[$item])) {
                $r[] = self::$canHear[$item];
            }
        }
        return $r;
    }

    public function getHardCaseName()
    {
        $r = [];
        foreach ($this->hardCases as $item) {
            if (isset(self::$hardCase[$item])) {
                $r[] = self::$hardCase[$item];
            }
        }
        return $r;
    }

    public function getIllName()
    {
        $r = [];
        foreach ($this->ills as $item) {
            if ($i = Ill::findOne($item)){
                $r[] = $i->name;
            }
        }
        return $r;
    }

    public function getToxicName()
    {
        $r = [];
        foreach ($this->toxics as $item) {
            if ($i = Ill::findOne($item)){
                $r[] = $i->name;
            }
        }
        return $r;
    }

    public function getMotherToxicName()
    {
        $r = [];
        foreach ($this->mother_toxics as $item) {
            if ($i = Ill::findOne($item)){
                $r[] = $i->name;
            }
        }
        return $r;
    }

    public function getGenderName()
    {
        return isset(User::$genderLabel[$this->gender]) ? User::$genderLabel[$this->gender] : '';
    }

    public static function getUsers()
    {
        $r = [];
        $data = self::find()->select('uid')->distinct(true)->all();
        foreach ($data as $item) {
            if ($item->user) {
                $r[$item->uid] = $item->user->name;
            }
        }
        return $r;
    }

    public static function getDoctors()
    {
        $r = [];
        $data = self::find()->select('doctor_id')->distinct(true)->all();
        foreach ($data as $item) {
            if ($item->doctor) {
                $r[$item->doctor_id] = $item->doctor->name;
            }
        }
        return $r;
    }
}
