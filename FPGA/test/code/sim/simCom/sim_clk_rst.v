/*
*                                        
* File  : sim_clk_rst.v
* Author: Duohua(Edward) Wang
* Init  : 09/20/2021
*/

`timescale 1ns/100ps

module sim_clk_rst
(
	output O_clk ,
	output O_rst ,
	output O_rstn 
);

parameter C_CLK_period = 10;

reg clk = 1'b0;

initial
	begin
		clk = 1'b0;
		forever
			#(C_CLK_period/2) clk = ~clk;
	end

assign O_clk = clk;

/********************Reset********************/
parameter C_Reset_Period = 3 * C_CLK_period;

reg reset = 1'b1;

initial @(posedge clk)
	#C_Reset_Period  reset = 1'b0;
	
assign O_rst  = reset;
assign O_rstn = !reset;

endmodule
