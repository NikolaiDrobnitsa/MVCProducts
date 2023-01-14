<?php

class ProductController
{
    protected $Product;

    /**
     * @param mixed $Product
     */
    public function setProduct($id,$price,$title,$description,$images): void
    {
        $this->Product = new Product($id,$price,$title,$description,$images);
    }

    public function FillTable(){
        echo '<tr  >';
        echo '<th scope="row" >'.$this->Product->getId().'</th>';
        echo  '<td>'.'<img alt="" src="data:image/jpeg;base64,'.base64_encode($this->Product->getImages()).' "height = "50" width="50"/>'.'</td>';
        echo  '<td>'.$this->Product->getTitle().'</td>';
        echo  '<td>'.$this->Product->getPrice().'</td>';
        echo  '<td>'.$this->Product->getDescription().'</td>';
        echo  "<td><button type= 'submit' class='btn btn-danger' name='delete_btn' value='{$this->Product->getId()}' >X</td>";
        echo "</tr>";


    }

    public function FillMainTable($NameProd){
        if ($this->Product->getTitle() == $NameProd){
            echo '<tr class="bg-info">';
        }
        else{
            echo '<tr >';
        }

        echo '<th scope="row" >'.$this->Product->getId().'</th>';
        echo  '<td>'.'<img src="data:image/jpeg;base64,'.base64_encode($this->Product->getImages()).' "height = "50" width="50"/>'.'</td>';
        echo  '<td>'.$this->Product->getTitle().'</td>';
        echo  '<td>'.$this->Product->getPrice().'</td>';
        echo  '<td>'.$this->Product->getDescription().'</td>';
        echo "</tr>";


    }

}