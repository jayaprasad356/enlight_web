<?php
namespace App\Exports;

use App\Models\Withdrawals;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WithdrawalsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Withdrawals::query()
            ->select(
                'withdrawals.id',
                'users.name as user_name',
                'users.mobile as user_mobile',
                'withdrawals.amount',
                'withdrawals.status',
                'withdrawals.datetime',
                'users.bank as bank_name',
                'users.branch as branch_name',
                'users.account_num as account_number',
                'users.holder_name as account_holder_name',
                'users.ifsc as ifsc_code'
            )
            ->join('users', 'withdrawals.user_id', '=', 'users.id');
    
        // Apply filters if they exist
        if (isset($this->filters['status'])) {
            $query->where('withdrawals.status', $this->filters['status']);
        }
    
        if (isset($this->filters['filter_date'])) {
            $query->whereDate('withdrawals.datetime', $this->filters['filter_date']);
        }
    
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Withdrawal ID',
            'User Name',
            'User Mobile',
            'Amount',
            'Status',
            'Date & Time',
            'Bank Name',
            'Branch Name',
            'Account Number',
            'Account Holder Name',
            'IFSC Code',
        ];
    }
}
