<?php

namespace Parasut;

Class Invoice extends Base
{
    public function show()
    {
        return $this->client->request(
          'sales_invoices/',
          [],
          'GET'
        );
    }

    public function checkPdf($id)
    {
        $response = $this->client->request(
            'sales_invoices/'.$id.'?include=active_e_document',
            [],
            'GET'
        );
        if (isset($response['included']) && isset($response['included'][0]['attributes']) && isset($response['included'][0]['attributes']['pdf_url'])) {
            return $response['included'][0]['attributes']['pdf_url'];
        }
        return false;
    }

    public function edit($id, $data)
    {
        return $this->client->request(
            'sales_invoices/'.$id,
            $data
        );
    }
    public function create($data)
    {
        return $this->client->request(
            'sales_invoices',
            $data
        );
    }

    public function pay($id, $data)
    {
        $resp = $this->client->request(
            'sales_invoices/'.$id.'/payments',
            $data
        );
        return $resp;
    }

    public function checkType($vkn)
    {
        return $this->client->request(
            'e_invoice_inboxes?filter[vkn]='.$vkn,
            [],
            'GET'
        );
    }

    public function create_e_archive($data)
    {
        return $this->client->request(
            'e_archives',
            $data
        );
    }

    public function show_e_archive($id)
    {
        return $this->client->request(
            'e_archives/'.$id,
            [],
            'GET'
        );
        
    }

    public function pdf_e_archive($id)
    {
        return $this->client->request(
            "e_archive/$id/pdf",
            [],
            'GET'
        );
    }

    public function create_e_invoice($data)
    {
        return $this->client->request(
            'e_invoices',
            $data
        );
    }

    public function show_e_invoice($id)
    {
        return $this->client->request(
          'e_invoices/'.$id,
            [],
            'GET'
        );
    }

    public function pdf_e_invoice($id)
    {
        return $this->client->request(
            "e_invoices/$id/pdf",
            [],
            'GET'
        );
    }

    public function checkJobStatus($id)
    {
        return $this->client->request(
            'trackable_jobs/'.$id,
            [],
            'GET'
        );
    }
}