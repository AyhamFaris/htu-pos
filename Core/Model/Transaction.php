<?php

namespace Core\Model;

use Core\Base\Model;

class Transaction extends Model
{

    public function get_today_transaction($user_id): array
    {
        $data = array();
        $date_now = date("m/d/Y");

        $stmt_relation = $this->connection->prepare("SELECT * FROM users_transactions WHERE user_id = ?");
        $stmt_relation->bind_param('i', $user_id);
        $stmt_relation->execute();
        $result = $stmt_relation->get_result();
        $stmt_relation->close();

        $transaction_id = array();
        foreach ($result as $transaction) {
            $transaction_id[] = $transaction['transaction_id'];
        }

        $data_result = array();
        foreach ($transaction_id as $transaction_select) {

            $stmt_join = $this->connection->prepare("SELECT transactions.*,items.title as title_name FROM transactions JOIN items ON transactions.item_id = items.id WHERE transactions.id=?");
            $stmt_join->bind_param('i', $transaction_select);
            $stmt_join->execute();
            $result_transaction = $stmt_join->get_result();
            $stmt_join->close();

            foreach ($result_transaction as $result_array) {

                $data_result[] = $result_array;
            }
        }

        foreach ($data_result as $result_data) {
            // $result_data['created_at'];
            $date = new \DateTime($result_data['created_at']);
            $result_data['created_at'] = $date->format('m/d/Y');

            if ($date_now == $result_data['created_at']) {
                $data[] = $result_data;
            }
        }
        return $data;
    }

    public function get_by_id_title($id)
    {
        $stmt_join_2 = $this->connection->prepare("SELECT transactions.*,items.title as title_name FROM transactions JOIN items ON transactions.item_id=items.id WHERE transactions.id=?");
        $stmt_join_2->bind_param('i', $id);
        $stmt_join_2->execute();
        $result = $stmt_join_2->get_result();
        $stmt_join_2->close();
        // $result = $this->connection->query("SELECT * FROM $this->table WHERE id=$id");
        return $result->fetch_object();
    }

    public function get_top_5(): array
    {
        $stmt_join_3 = $this->connection->prepare("SELECT transactions.*,items.title as title_name FROM transactions JOIN items ON transactions.item_id=items.id ORDER BY transactions.id desc  LIMIT 5");
        $stmt_join_3->execute();
        $result = $stmt_join_3->get_result();
        $stmt_join_3->close();
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


}