/*
* File  : comDelay.v
* Author: Duohua(Edward) Wang
* Init  : 09/25/2021
*/
`timescale 1ns/100ps

module comDelay #
(
    parameter C_DELAY_CLK_NUM = 10'd10 /* minimun is 2, maximum is 1024 */
)
(
    input         I_clk    ,
    input         I_rst    ,
    input  [31:0] I_srcData,
    output [31:0] O_dstData 
);

wire [31:0] D_dstData;
wire [ 9:0] S_DelayClkNum;

assign S_DelayClkNum = C_DELAY_CLK_NUM - 2;

c_shift_ram_32Wx1024D U_shift_ram_32Wx1024D_inst
(
    .CLK  (I_clk          ),
    .A    (S_DelayClkNum  ),
    .D    (I_srcData      ),
    .Q    (D_dstData      ) 
);

assign O_dstData = D_dstData;

endmodule

