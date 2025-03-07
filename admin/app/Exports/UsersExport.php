<?php
namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Users::select(
            'id',
            'mobile',
            'name',
            'age',
            'pincode',
            'gender',
            'status',
            'refer_code',
            'today_income',
            'total_income',
            'team_income',
            'refer_income',
            'level_income',
            'whatsapp_status_income',
            'monthly_salary',
            'level_1_refer',
            'level_2_refer',
            'level_3_refer',
            'level_4_refer',
            'account_num',
            'holder_name',
            'bank',
            'branch',
            'ifsc',
            'balance',
            'recharge',
            'total_recharge',
            'total_withdrawal',
            'registered_datetime',
            'password',
            'updated_at',
            'created_at',
            'level_income_wallet'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Mobile',
            'Name',
            'Age',
            'Pincode',
            'Gender',
            'Status',
            'Refer Code',
            'Today Income',
            'Total Income',
            'Team Income',
            'Refer Income',
            'Level Income',
            'WhatsApp Status Income',
            'Monthly Salary',
            'Level 1 Refer',
            'Level 2 Refer',
            'Level 3 Refer',
            'Level 4 Refer',
            'Account Number',
            'Account Holder Name',
            'Bank Name',
            'Branch Name',
            'IFSC Code',
            'Balance',
            'Recharge',
            'Total Recharge',
            'Total Withdrawal',
            'Registered DateTime',
            'Password',
            'Updated At',
            'Created At',
            'Level Income Wallet'
        ];
    }
}
