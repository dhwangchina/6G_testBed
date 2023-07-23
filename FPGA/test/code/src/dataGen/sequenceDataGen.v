/*
*                                        
* File  : sequenceDataGen.v
* Author: Duohua(Edward) Wang
* Init  : 09/29/2021
*/

`timescale 1ns/100ps

module sequenceDataGen
(
    input         I_clk   ,
    input         I_rst   ,
    input         I_rReady,
    output        O_DataEn,
    output [31:0] O_Data   
);


reg        S_DataEn = 1'b0;
reg [31:0] S_Data   = 32'd0;

always @ (posedge I_clk)
    begin
        if(I_rst)
            begin
                S_DataEn <= 1'b0;
                S_Data   <= 32'd0;
            end
        else
            begin
                S_DataEn <= 1'b1;
                S_Data   <= S_Data + 32'd1;
            end
    end


assign O_DataEn = S_DataEn;
assign O_Data   = S_Data  ;

endmodule
