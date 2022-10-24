<?php

namespace app\modules\api\modules\v1\models;

use Yii;
use app\traits\AuditTrailsTrait;
/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string location
 * @property string $password
 * @property string|null $token_id
 * @property int $is_active
 * @property string|null $lang
 * @property int|null $mobile
 * @property int|null $role
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AccountCategories[] $accountCategories
 * @property AccountCategories[] $accountCategories0
 * @property Accounts[] $accounts
 * @property Accounts[] $accounts0
 * @property BankAccounts[] $bankAccounts
 * @property BankAccounts[] $bankAccounts0
 * @property BillDetails[] $billDetails
 * @property BillDetails[] $billDetails0
 * @property BillPayments[] $billPayments
 * @property BillPayments[] $billPayments0
 * @property Bills[] $bills
 * @property Bills[] $bills0
 * @property User $createdBy
 * @property Customers[] $customers
 * @property Customers[] $customers0
 * @property EstmateDetails[] $estmateDetails
 * @property EstmateDetails[] $estmateDetails0
 * @property Estmates[] $estmates
 * @property Estmates[] $estmates0
 * @property InvoiceDetails[] $invoiceDetails
 * @property InvoiceDetails[] $invoiceDetails0
 * @property InvoicePayments[] $invoicePayments
 * @property InvoicePayments[] $invoicePayments0
 * @property Invoices[] $invoices
 * @property Invoices[] $invoices0
 * @property Products[] $products
 * @property Products[] $products0
 * @property PurchaseOrderDetails[] $purchaseOrderDetails
 * @property PurchaseOrderDetails[] $purchaseOrderDetails0
 * @property PurchaseOrders[] $purchaseOrders
 * @property PurchaseOrders[] $purchaseOrders0
 * @property Suppliers[] $suppliers
 * @property Suppliers[] $suppliers0
 * @property Transactions[] $transactions
 * @property Transactions[] $transactions0
 * @property User $updatedBy
 * @property User[] $users
 * @property User[] $users0
 */
class User extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;

    
    const ROLE_ROOT = 100;
    const ROLE_ADMIN = 101;
    const ROLE_POMPE = 102;
    const ROLE_MANAGER = 103;
    const ROLE_CASHIER = 104;
    const ROLE_DECHARGEMENT = 105;
    const ROLE_DISTRIBUTOR = 106;
    




    public $text_password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username','lang', 'password', 'is_active','location'], 'required'],
            [['text_password'], 'required', 'when' => function ($model) {
                return $model->isNewRecord;
            }],
            [['is_active', 'mobile', 'role', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'username', 'location','password','text_password', 'token_id', 'lang'], 'string', 'max' => 100],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'token_id' => Yii::t('app', 'Token ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'lang' => Yii::t('app', 'Language'),
            'mobile' => Yii::t('app', 'Mobile'),
            'role' => Yii::t('app', 'Role'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'text_password' => Yii::t('app', 'Password'),
            'location' => Yii::t('app', 'Station'),
        ];
    }

    /**
     * Gets query for [[AccountCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
     
      public function beforeSave($insert)
    {
        if (!empty($this->text_password)) {
            $this->password = Yii::$app->security->generatePasswordHash($this->text_password);
        }

        return parent::beforeSave($insert);
    }
     
    public function getAccountCategories()
    {
        return $this->hasMany(AccountCategories::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[AccountCategories0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCategories0()
    {
        return $this->hasMany(AccountCategories::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Accounts::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Accounts0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts0()
    {
        return $this->hasMany(Accounts::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[BankAccounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts()
    {
        return $this->hasMany(BankAccounts::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[BankAccounts0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts0()
    {
        return $this->hasMany(BankAccounts::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[BillDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillDetails()
    {
        return $this->hasMany(BillDetails::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[BillDetails0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillDetails0()
    {
        return $this->hasMany(BillDetails::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[BillPayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillPayments()
    {
        return $this->hasMany(BillPayments::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[BillPayments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillPayments0()
    {
        return $this->hasMany(BillPayments::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bills::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Bills0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills0()
    {
        return $this->hasMany(Bills::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Customers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers0()
    {
        return $this->hasMany(Customers::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[EstmateDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstmateDetails()
    {
        return $this->hasMany(EstmateDetails::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[EstmateDetails0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstmateDetails0()
    {
        return $this->hasMany(EstmateDetails::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Estmates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstmates()
    {
        return $this->hasMany(Estmates::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Estmates0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstmates0()
    {
        return $this->hasMany(Estmates::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[InvoiceDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[InvoiceDetails0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceDetails0()
    {
        return $this->hasMany(InvoiceDetails::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[InvoicePayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicePayments()
    {
        return $this->hasMany(InvoicePayments::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[InvoicePayments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicePayments0()
    {
        return $this->hasMany(InvoicePayments::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoices::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Invoices0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices0()
    {
        return $this->hasMany(Invoices::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Products::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[PurchaseOrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderDetails()
    {
        return $this->hasMany(PurchaseOrderDetails::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[PurchaseOrderDetails0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderDetails0()
    {
        return $this->hasMany(PurchaseOrderDetails::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[PurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrders::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[PurchaseOrders0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders0()
    {
        return $this->hasMany(PurchaseOrders::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Suppliers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers0()
    {
        return $this->hasMany(Suppliers::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Transactions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions0()
    {
        return $this->hasMany(Transactions::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['updated_by' => 'id']);
    }
    public function validateRole($attribute, $params, $validator)
    {
        if (!in_array($this->$attribute, array_keys(self::getRoles()))) {
            $this->addError($attribute, Yii::t('app', 'Invalid Role'));
        }
    }
    
     public static function getRoles()
    {
        return [
            self::ROLE_ROOT => Yii::t('app', 'Super Administrator'),
            self::ROLE_ADMIN => Yii::t('app', 'Administrator'),
            self::ROLE_MANAGER => Yii::t('app', 'Manager '),
            self::ROLE_DECHARGEMENT => Yii::t('app', 'Dechargement'),
            
            self::ROLE_CASHIER => Yii::t('app', 'Cashier'),
            self::ROLE_POMPE => Yii::t('app', 'Pompist Agent'),
            self::ROLE_DISTRIBUTOR => Yii::t('app', 'Distributor Agent'),
            
        ];
    }
    
     public function generateToken()
    {
        $this->token_id = hash('SHA256', Yii::$app->security->generateRandomString());
        $this->save(false);
    }
    
     public function isAdmin()
    {
        return $this->role == '103' || $this->isManager() || $this->isSuperAdmin();
    }
     public function isFuel()
    {
        return $this->role == '101' || $this->isManager() || $this->isAdmin();
    }
     public function isGarage()
    {
        return $this->role == '106' || $this->isManager() || $this->isAdmin();
    }
     public function isMeal()
    {
        return $this->role == '107' || $this->isManager() || $this->isAdmin();
    }
     public function isParking()
    {
        return $this->role == '108' || $this->isManager() || $this->isAdmin();
    }
     public function isCarwash()
    {
        return $this->role == '109' || $this->isManager() || $this->isAdmin();
    }
    public function isLeasing()
    {
        return $this->role == '110' || $this->isManager() || $this->isAdmin();
    }
    public function isFine()
    {
        return $this->role == '111' || $this->isManager() || $this->isAdmin();
    }
    
    public function isManager()
    {
        return $this->role == 'manager' || $this->isDirector();
    }
    
    public function isSuperAdmin()
    {
        return $this->role == 'root' || $this->isDirector();
    }
    
    public function isDirector()
    {
        return $this->role == 'director';
    }
    
    public function getStaffRole()
    {
        $roles = $this->getRoles();
        return $roles[$this->role];
    }
    
     
}
