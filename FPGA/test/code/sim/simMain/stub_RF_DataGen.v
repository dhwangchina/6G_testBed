/*
*                                        
* File  : stub_RF_DataGen.v
* Author: Duohua(Edward) Wang
* Init  : 09/30/2021
*/

`timescale 1ns/100ps
module stub_RF_DataGen
(
    input         I_clk     ,
    input         I_rst     ,
    input         I_tReady  ,
    output        O_RF_txXEn,
    output [11:0] O_RF_tx0Im,
    output [11:0] O_RF_tx0Re,
    output [11:0] O_RF_tx1Im,
    output [11:0] O_RF_tx1Re 
);

reg [31:0] S_cntr     = 32'd0;
reg        S_RF_txXEn =  1'b0;
reg [11:0] S_RF_tx0Im = 12'd0;
reg [11:0] S_RF_tx0Re = 12'd0;
reg [11:0] S_RF_tx1Im = 12'd0;
reg [11:0] S_RF_tx1Re = 12'd0;

always @ (posedge I_clk)
    begin
        if(I_rst || !I_tReady)
            begin
                S_cntr     <= 32'd0;
                S_RF_txXEn <=  1'b0;
                S_RF_tx0Im <= 12'd0;
                S_RF_tx0Re <= 12'd0;
                S_RF_tx1Im <= 12'd0;
                S_RF_tx1Re <= 12'd0;
            end
        else
            begin
                S_cntr <= S_cntr + 32'd1;
                if(0 == (S_cntr + 2) % 4)
                    begin
                        S_RF_txXEn <= 1'b1;
                    end
                else if(0 == (S_cntr + 1) % 4)
                    begin
                        S_RF_txXEn <= 1'b0;
                        S_RF_tx0Im <= S_RF_tx0Im + 12'd1;
                        S_RF_tx0Re <= S_RF_tx0Re + 12'd2;
                        S_RF_tx1Im <= S_RF_tx1Im + 12'd3;
                        S_RF_tx1Re <= S_RF_tx1Re + 12'd4;
                    end
                else
                    begin
                        S_RF_txXEn <= 1'b0;
                        S_RF_tx0Im <= S_RF_tx0Im;
                        S_RF_tx0Re <= S_RF_tx0Re;
                        S_RF_tx1Im <= S_RF_tx1Im;
                        S_RF_tx1Re <= S_RF_tx1Re;
                    end
            end
    end


assign O_RF_txXEn = S_RF_txXEn;
assign O_RF_tx0Im = S_RF_tx0Im;
assign O_RF_tx0Re = S_RF_tx0Re;
assign O_RF_tx1Im = S_RF_tx1Im;
assign O_RF_tx1Re = S_RF_tx1Re;

endmodule