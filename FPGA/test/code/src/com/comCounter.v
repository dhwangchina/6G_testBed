/*
* File  : comCounter.v
* Author: Duohua(Edward) Wang
* Init  : 09/25/2021
*/
`timescale 1ns/100ps

module comCounter #
(
    parameter C_COUNT_NUM = 32'd100
)
(
    input  I_clk   ,
    input  I_rst   ,
    output O_cntFlg 
);

reg [31: 0] count = 32'd0;
reg         flg   = 1'b0;

always @ (posedge I_clk)
    begin
        if(I_rst)
            begin
                count <= 32'd0;
                flg   <= 1'b0;
            end
        else
            begin
                if(C_COUNT_NUM == count + 1)
                    begin
                        count <= 32'd0;
                        flg   <= 1'b1;
                    end
                else
                    begin
                        count <= count + 32'd1;
                        flg   <= 1'b0;
                    end
            end
    end

assign O_cntFlg = flg;

endmodule